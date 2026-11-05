# github-actions-cicd

I'm a Linux system administrator. At work I deploy websites to staging and
production servers myself — by hand, over SSH, with a mental checklist. It
works, but nothing double-checks the code before it lands, and the steps live
in my head instead of in the repo.

So I'm learning **CI/CD with GitHub Actions**: first getting a machine to lint
and test the code on every push, then automating the deploy I already do
manually. This repo is my practice ground — a deliberately tiny PHP page, just
enough code to have something to check and ship. I'm learning the pipeline,
not showing off an app.

## What's in here

| File | What it does |
| --- | --- |
| `index.php` | The tiny practice page. Says hello, takes an optional `?name=` parameter. |
| `src/greeting.php` | The one function the page uses — kept separate so the test can load it without the HTML. |
| `tests/smoke-test.php` | A plain-PHP assertion script (no framework): checks `greeting()` behaves. Exits non-zero on failure. |
| `.github/workflows/ci.yml` | Runs on push and pull requests: PHP lint on every PHP file, then the smoke test. |
| `.github/workflows/deploy.yml` | Manual-trigger (`workflow_dispatch`) deploy to a VPS over SSH, using repository secrets. Practice values only. |

## The pipeline stages I practiced

1. **Lint** — `php -l` on every PHP file. Catches syntax errors before
   anything else runs. Fast and boring, which is what you want first.
2. **Test** — run `tests/smoke-test.php` with the same PHP version the
   server uses (8.2 here). One small test that actually exercises the code
   beats a test suite I copied and don't understand.
3. **Deploy** — only when I press the button (Actions tab → deploy →
   Run workflow). It connects to the VPS over SSH with a key stored in
   GitHub secrets and does what I used to type by hand: `git pull` in the
   site directory and restart PHP-FPM. Manual trigger while I learn —
   auto-deploying on every push is a step I'll take when I trust the
   first two stages.

## Secrets the deploy workflow expects

Set these under Settings → Secrets and variables → Actions. Never commit
real values — the repo only ever contains placeholder documentation.

| Secret | What it is |
| --- | --- |
| `VPS_HOST` | Hostname or IP of the practice VPS (placeholder example: `vps.example.com`) |
| `VPS_USER` | SSH user on that VPS, e.g. `deploy` |
| `VPS_SSH_KEY` | Private key for that user (the public half lives in the server's `authorized_keys`) |

## Running the checks locally

```bash
php -l index.php src/greeting.php tests/smoke-test.php
php tests/smoke-test.php
php -S localhost:8000   # then open http://localhost:8000/?name=Ilham
```
