# CLAUDE.md — Cameron West Author Website
> Drop this file in the root of your `z.CAMWESTAUTHOR` project folder.
> Claude will automatically read it when you start a session in that directory.

---

## Project Identity
- **Site**: cameronwestauthor.com
- **Author**: Cameron West, PhD
- **Featured Book**: *First Person Plural: My Life as a Multiple* (25th Anniversary Edition) — NYT Bestseller
- **Repo**: https://github.com/seanphillip/cameronwestauthor
- **Stack**: Plain HTML5 / CSS3 / Vanilla JS (no framework)
- **Hosting**: GitHub Pages or existing host

---

## Project Goal
Redesign cameronwestauthor.com with a sophisticated dark literary aesthetic derived from the *First Person Plural* 25th Anniversary Edition book cover. This is a visual/UX redesign — all existing content is preserved.

---

## Design System

### Colors
```css
:root {
  --color-bg:          #0A0A0A;
  --color-surface:     #1A1918;
  --color-border:      #2E2B28;
  --color-text:        #F0EDE8;
  --color-text-muted:  #D4C5B5;
  --color-accent:      #C4805A;  /* Copper — primary accent */
  --color-accent-dark: #8B6F5E;
}
```

### Typography
```css
:root {
  --font-display: 'Playfair Display', Georgia, serif;  /* Headlines */
  --font-body:    'Lora', Georgia, serif;               /* Body copy */
  --font-label:   'Cinzel', serif;                      /* Labels, badges */
}
```

### Google Fonts
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Lora:ital,wght@0,400;0,500;1,400&family=Cinzel:wght@400;600&display=swap" rel="stylesheet">
```

---

## File Structure
```
z.CAMWESTAUTHOR/
├── CLAUDE.md               ← You are here
├── index.html              ← Main single-page site
├── resources.html          ← DID/trauma resource links
├── contact.html            ← Contact form
├── css/
│   └── style.css           ← Main stylesheet
├── js/
│   └── main.js             ← Any JS interactions
└── img/
    ├── FPP.png             ← First Person Plural cover
    ├── FPP-banner.png      ← Hero banner (desktop)
    ├── FPP-banner-mobile.png
    ├── cameron_west.jpg    ← Author photo
    ├── signature.png       ← Author signature graphic
    ├── amazon.png          ← Review source logo
    ├── barnes.png          ← Review source logo
    └── goodreads.png       ← Review source logo
```

---

## Site Sections (index.html)
1. **Nav** — sticky, dark, minimal with copper hover
2. **Hero** — full-bleed dark, book cover, author name, Oprah quote
3. **About** — bio, author photo, credentials
4. **Books** — First Person Plural (featured) + The Medici Dagger
5. **Editorial Reviews** — Publisher's Weekly, Library Journal
6. **Reader Reviews** — Amazon, Goodreads, Barnes & Noble
7. **Footer** — contact link, copyright

---

## Component Patterns

### Blockquotes / Pull Quotes
```css
blockquote {
  border-left: 3px solid var(--color-accent);
  padding-left: 1.5rem;
  font-style: italic;
  color: var(--color-text-muted);
}
```

### Buttons
```css
/* Primary */
.btn-primary {
  background: var(--color-accent);
  color: var(--color-bg);
  border: none;
}
/* Secondary */
.btn-secondary {
  background: transparent;
  border: 1px solid var(--color-accent);
  color: var(--color-accent);
}
```

### Section Dividers
```css
.section-divider {
  border: none;
  border-top: 1px solid var(--color-accent);
  opacity: 0.4;
  margin: var(--section-gap) 0;
}
```

---

## Layout Tokens
```css
:root {
  --max-width:   1100px;
  --gutter:      clamp(1.5rem, 5vw, 4rem);
  --section-gap: clamp(4rem, 10vw, 8rem);
  --line-height: 1.8;
}
```

---

## Responsive Breakpoints
- **Mobile**: < 768px
- **Tablet**: 768px – 1100px
- **Desktop**: > 1100px
- Approach: **mobile-first**

---

## Git Workflow
```bash
# After making changes:
git add .
git commit -m "describe what changed"
git push
```

---

## Full Project Brief
See `CAMERON_WEST_PROJECT_BRIEF.md` for the complete design brief including mood, inspiration, and page-by-page specs.

---

## Change Log

| Date | Category | Notes |
|------|----------|-------|
| Mar 2026 | Repo cleanup | Removed 239 legacy files — Bootstrap, jQuery plugins, Colorlib template assets, Font Awesome, Linearicons. Repo reduced from ~280 to 41 tracked files. All styles inline in HTML. |

---

*Last updated: March 2026*
