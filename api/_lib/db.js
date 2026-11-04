import { neon } from '@neondatabase/serverless';

// DATABASE_URL is added to the Vercel project by the Neon integration.
export function db() {
  return neon(process.env.DATABASE_URL);
}
