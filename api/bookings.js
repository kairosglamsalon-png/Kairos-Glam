import { db } from './_lib/db.js';
import { isLoggedIn } from './_lib/auth.js';

export default async function handler(req, res) {
  if (req.method !== 'GET') return res.status(405).json({ error: 'Method not allowed' });
  if (!isLoggedIn(req)) return res.status(401).json({ error: 'Not logged in' });

  try {
    const sql = db();
    // to_char keeps the date as plain text, so it is not shifted by time zones.
    const rows = await sql`
      SELECT id, name, phone, email, service,
             to_char(booking_date, 'YYYY-MM-DD') AS booking_date,
             booking_time, message, created_at
      FROM bookings
      ORDER BY id DESC`;
    res.setHeader('Cache-Control', 'no-store');
    return res.status(200).json({ bookings: rows });
  } catch (err) {
    console.error('Loading bookings failed:', err);
    return res.status(500).json({ error: 'Could not load bookings' });
  }
}
