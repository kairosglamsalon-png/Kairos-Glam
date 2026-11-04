import crypto from 'node:crypto';

// Admin session: a signed cookie, so no server-side session store is needed.
const COOKIE = 'kg_admin';
const MAX_AGE = 60 * 60 * 12; // 12 hours

function sign(value) {
  return crypto.createHmac('sha256', process.env.SESSION_SECRET).update(value).digest('base64url');
}

// Constant-time comparison that also hides the length of the secret.
export function safeEqual(a, b) {
  const x = crypto.createHash('sha256').update(String(a)).digest();
  const y = crypto.createHash('sha256').update(String(b)).digest();
  return crypto.timingSafeEqual(x, y);
}

export function createSessionCookie(username) {
  const payload = Buffer.from(JSON.stringify({ u: username, exp: Date.now() + MAX_AGE * 1000 })).toString('base64url');
  return `${COOKIE}=${payload}.${sign(payload)}; Path=/; HttpOnly; Secure; SameSite=Strict; Max-Age=${MAX_AGE}`;
}

export function clearSessionCookie() {
  return `${COOKIE}=; Path=/; HttpOnly; Secure; SameSite=Strict; Max-Age=0`;
}

export function isLoggedIn(req) {
  if (!process.env.SESSION_SECRET) return false;
  const match = (req.headers.cookie || '').match(/(?:^|;\s*)kg_admin=([^;]+)/);
  if (!match) return false;
  const [payload, sig] = match[1].split('.');
  if (!payload || !sig || !safeEqual(sig, sign(payload))) return false;
  try {
    return JSON.parse(Buffer.from(payload, 'base64url').toString()).exp > Date.now();
  } catch {
    return false;
  }
}
