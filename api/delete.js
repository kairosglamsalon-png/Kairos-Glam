import { db } from './_lib/db.js';
import { isLoggedIn } from './_lib/auth.js';

export default async function handler(req, res) {
  if (req.method !== 'POST') return res.status(405).json({ error: 'Method not allowed' });
  if (!isLoggedIn(req)) return res.status(401).json({ error: 'Not logged in' });

  const id = Number((req.body || {}).id);
  if (!Number.isInteger(id) || id <= 0) return res.status(400).json({ error: 'Invalid booking id' });

  try {
    const sql = db();
    const rows = await sql`DELETE FROM bookings WHERE id = ${id} RETURNING id`;
    if (rows.length === 0) return res.status(404).json({ error: 'Booking not found' });
    return res.status(200).json({ ok: true });
  } catch (err) {
    console.error('Deleting booking failed:', err);
    return res.status(500).json({ error: 'Could not delete booking' });
  }
}
