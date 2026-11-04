import { db } from './_lib/db.js';

// Max length kept for each field; anything longer is cut off.
const LIMITS = { name: 50, phone: 20, email: 100, services: 1000, date: 10, time: 10, message: 300 };

export default async function handler(req, res) {
  if (req.method !== 'POST') return res.status(405).json({ error: 'Method not allowed' });

  const body = req.body || {};
  const f = {};
  for (const [key, max] of Object.entries(LIMITS)) {
    f[key] = String(body[key] ?? '').trim().slice(0, max);
  }

  if (!f.name || !f.phone || !f.email) {
    return res.status(400).json({ error: 'Name, phone and email are required' });
  }

  const date = /^\d{4}-\d{2}-\d{2}$/.test(f.date) ? f.date : null;

  try {
    const sql = db();
    const rows = await sql`
      INSERT INTO bookings (name, phone, email, service, booking_date, booking_time, message)
      VALUES (${f.name}, ${f.phone}, ${f.email}, ${f.services}, ${date}, ${f.time}, ${f.message})
      RETURNING id`;
    return res.status(200).json({ ok: true, id: rows[0].id });
  } catch (err) {
    console.error('Saving booking failed:', err);
    return res.status(500).json({ error: 'Could not save booking' });
  }
}
