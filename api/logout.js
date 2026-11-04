import { clearSessionCookie } from './_lib/auth.js';

export default function handler(req, res) {
  res.setHeader('Set-Cookie', clearSessionCookie());
  res.setHeader('Location', '/admin/login.html');
  return res.status(302).end();
}
