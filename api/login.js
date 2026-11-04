import { createSessionCookie, safeEqual } from './_lib/auth.js';

export default function handler(req, res) {
  if (req.method !== 'POST') return res.status(405).json({ error: 'Method not allowed' });

  const { ADMIN_USERNAME, ADMIN_PASSWORD, SESSION_SECRET } = process.env;
  if (!ADMIN_USERNAME || !ADMIN_PASSWORD || !SESSION_SECRET) {
    return res.status(500).json({ error: 'Admin login is not configured' });
  }

  const { username = '', password = '' } = req.body || {};
  // Check both so a wrong username takes as long as a wrong password.
  const userOk = safeEqual(String(username).trim(), ADMIN_USERNAME);
  const passOk = safeEqual(password, ADMIN_PASSWORD);

  if (!(userOk && passOk)) {
    return res.status(401).json({ error: 'Invalid Username or Password' });
  }

  res.setHeader('Set-Cookie', createSessionCookie(ADMIN_USERNAME));
  return res.status(200).json({ ok: true });
}
