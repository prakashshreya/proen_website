# PROEN Website — Image Replacement Checklist

Every image in the site that needs an official PROEN asset is marked inline
in the HTML with an `<!-- REPLACE: ... -->` comment directly above it,
describing exactly what's needed. Search any file for `REPLACE:` to find
them in context. This document is the master summary — organized by asset
type, since most images (logo, team photos, office shots) repeat across
many pages.

Images **not** marked with a `REPLACE:` comment are decorative stock/texture
assets from the FinanDox template (backgrounds, abstract shapes, icon
tiles) and don't need real photography — they're fine to keep as-is or
swap later purely for visual refresh, not correctness.

## Priority 1 — Brand essentials (used on every single page)

| Asset | Appears in | Notes |
|---|---|---|
| **Logo** (transparent PNG/SVG) | Header top-left, mobile menu, footer | Currently `assets/images/logo.png`. Need a light/dark or transparent variant depending on final header background. |
| **Sticky-header logo** | Sticky nav bar on scroll | `assets/images/sticky-logo.png` — usually a simplified/light mark for a slim bar. |
| **Footer logo** | Footer, every page | `assets/images/footer-logo.png` — typically a light/white logo variant for a dark footer background. |
| **Favicon** | Browser tab, every page | `assets/images/favicon.png` — square mark, works at 16–32px. |

## Priority 2 — Leadership & team photography

All 7 people appear with photo placeholders on **team.html**, **team-details.html**, and the 3 leadership cards repeat on **every homepage variant** (index.html, index-2/3/4, index-4-style-two, onepage, rtl.html, rtl-home.html):

| Person | Title |
|---|---|
| Veeresh Vastrad | Chief Executive Officer |
| Vishwanathaswamy K M | Head of Technology |
| Mukund Kagatikar | Co-founder & CLM Practice Head |
| Kedar Vaidya | Advisor, CLM Practice |
| Nilesh Ambadkar | Integration Architect |
| Yanka Pandey | Associate Architect |
| Swarnendu Sarkar | Principal Consultant |

Professional headshots (consistent lighting/background across all 7)
would have the single biggest visual impact on the site's credibility.

## Priority 3 — Office & culture photography

Used across homepages' About/Why-Choose-Us/Certifications sections and
about.html:
- Bengaluru HQ office — exterior and/or interior shots
- Team working / collaboration shots
- A "product screen" shot of a CLM platform in use (for the About section's secondary image) — can be a screenshot of an actual client-facing dashboard if available, blurred/anonymized if needed

## Priority 4 — Certifications & partner logos

Appears on index.html and homepage variants' "Recognition"/Certifications
section, and on about.html:
- Official ISO certification badge/seal
- Any technology partner or vendor logos PROEN wants to display (currently generic placeholder logo slots — remove the slots entirely if there are no real partner logos to show yet)

## Priority 5 — Case studies / client logos

- **portfolio-1.html, portfolio-2.html, portfolio-details.html, and homepage variants**: case-study cover images (currently stock gallery photos) for the 8 illustrative case studies (Global Retailer CLM Rollout, Spectrum Mobility Contract Governance, etc.) — replace once real, approved client stories are available. These are marked with `NOTE:` comments as illustrative/composed narratives, not confirmed public case studies — legal/marketing sign-off needed before publishing as-is.
- **Client/partner logo carousel** (appears on portfolio pages and careers.html) — currently generic placeholder logos; swap for real client logos with permission, or remove the carousel if none are approved for public display yet.

## Priority 6 — Product screenshots

- **product-details.html**: real screenshots of the **Contract Diligence** product (the ChatGPT-integrated contract-authoring plug-in) — currently stock imagery.

## Priority 7 — Social & Instagram feed

- Footer "Follow @proenconsultingservices" widget (9-image grid, every page): swap for a live Instagram feed embed or real office/culture photos.

## Priority 8 (lowest) — Insights/blog cover art & background textures

- blog-grid.html, blog-standard.html, blog-details.html: article cover images are suggested stock art, not required to be "official" photos — any on-brand imagery works since Insights content itself is placeholder pending real published articles (see `NOTE:` comments in those files).
- Various section background photos/textures throughout (hero banners, video-section backgrounds, etc.) — cosmetic, can stay as template stock indefinitely if a full photo shoot isn't planned soon.

## How to update once real assets are ready

1. Drop new files into `assets/images/` (keep existing filenames to avoid touching markup, or do a careful find-and-replace of the `src=`/`data-src=` paths).
2. Search the codebase for `REPLACE:` to confirm every marked spot has been addressed; delete the comment once done so the checklist stays accurate over time.
3. Re-run a visual pass on `index.html`, `about.html`, `team.html`, and `contact.html` first — highest-traffic pages.
