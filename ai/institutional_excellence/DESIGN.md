---
name: Institutional Excellence
colors:
  surface: '#faf8ff'
  surface-dim: '#d9d9e4'
  surface-bright: '#faf8ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f3f3fe'
  surface-container: '#ededf8'
  surface-container-high: '#e7e7f3'
  surface-container-highest: '#e2e1ed'
  on-surface: '#191b23'
  on-surface-variant: '#434654'
  inverse-surface: '#2e3039'
  inverse-on-surface: '#f0f0fb'
  outline: '#737686'
  outline-variant: '#c3c5d7'
  surface-tint: '#1353d8'
  primary: '#003fb1'
  on-primary: '#ffffff'
  primary-container: '#1a56db'
  on-primary-container: '#d4dcff'
  inverse-primary: '#b5c4ff'
  secondary: '#5c5f60'
  on-secondary: '#ffffff'
  secondary-container: '#e1e3e4'
  on-secondary-container: '#626566'
  tertiary: '#3f4a5e'
  on-tertiary: '#ffffff'
  tertiary-container: '#576276'
  on-tertiary-container: '#d3def6'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#dbe1ff'
  primary-fixed-dim: '#b5c4ff'
  on-primary-fixed: '#00174d'
  on-primary-fixed-variant: '#003dab'
  secondary-fixed: '#e1e3e4'
  secondary-fixed-dim: '#c5c7c8'
  on-secondary-fixed: '#191c1d'
  on-secondary-fixed-variant: '#454748'
  tertiary-fixed: '#d8e3fb'
  tertiary-fixed-dim: '#bcc7de'
  on-tertiary-fixed: '#111c2d'
  on-tertiary-fixed-variant: '#3c475a'
  background: '#faf8ff'
  on-background: '#191b23'
  surface-variant: '#e2e1ed'
typography:
  h1:
    fontFamily: Public Sans
    fontSize: 40px
    fontWeight: '700'
    lineHeight: '1.2'
  h2:
    fontFamily: Public Sans
    fontSize: 30px
    fontWeight: '600'
    lineHeight: '1.3'
  h3:
    fontFamily: Public Sans
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.4'
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.5'
  body-sm:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: '1.5'
  label-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '600'
    lineHeight: '1.2'
  label-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '500'
    lineHeight: '1.2'
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  container-max: 1280px
  gutter: 1.5rem
  margin-mobile: 1rem
  margin-desktop: 2.5rem
  stack-sm: 0.5rem
  stack-md: 1rem
  stack-lg: 2rem
---

## Brand & Style

This design system is engineered to project authority, reliability, and academic rigor. The target audience includes prospective students, active students, faculty members, and administrative staff. The UI must evoke a sense of trust and "organized efficiency," ensuring that complex administrative tasks like course registration (SIAKAD) and student admission (PMB) feel manageable and secure.

The visual style is **Corporate / Modern**. It prioritizes a clear information hierarchy and functional aesthetics. It avoids decorative clutter in favor of purposeful whitespace and structured layouts. The emotional response should be one of stability and clarity—positioning the university as a prestigious, forward-thinking institution.

## Colors

The color palette is rooted in **Deep Institutional Blue**, representing intelligence and stability. 

- **Primary:** #1A56DB (Deep Institutional Blue) is used for primary actions, active states, and branding elements.
- **Secondary/Background:** A range of clean whites (#FFFFFF) and light grays (#F3F4F6, #F9FAFB) are used to differentiate content areas without adding visual noise.
- **Professional Navy:** #1E293B is reserved for sidebars, footers, and high-level headings to provide grounded contrast.
- **Semantic Accents:** 
    - **Success Green (#059669):** Specifically for "Lulus Seleksi," "Pembayaran Berhasil," and "Status Aktif."
    - **Warning Amber (#D97706):** Used for "Menunggu Verifikasi," "Tagihan Pending," and important deadlines.
    - **Error Red (#DC2626):** Reserved for "Ditolak," "Batas Waktu Terlewati," or system errors.

## Typography

This design system utilizes **Public Sans** for headings to provide an institutional, government-grade clarity, and **Inter** for body text and interface elements to ensure maximum legibility at small sizes.

High readability is the priority. Headings use a slightly tighter line-height for impact, while body text uses a generous 1.5-1.6 line-height to facilitate reading long academic transcripts or registration guidelines. All labels (kategori, status) should use Medium or Semi-bold weights to distinguish them from standard body text.

## Layout & Spacing

The design system employs a **12-column Fluid Grid** for desktop and a single-column layout for mobile devices. 

- **SIAKAD (Dashboard):** Uses a fixed sidebar (280px) with a fluid content area for data-heavy tables and forms.
- **PMB (Landing & Form):** Uses a centered fixed-width grid (max-width 1280px) to maintain focus during the registration process.
- **Rhythm:** A base-8 spacing scale is used. Consistent padding of 24px (1.5rem) inside cards and 16px (1rem) between list items ensures a clean, breathable interface.

## Elevation & Depth

Visual hierarchy is established through **Tonal Layers** and **Ambient Shadows**. 

1. **Surface Level (0):** The main background uses the secondary light gray (#F9FAFB).
2. **Card Level (1):** White containers (#FFFFFF) use a subtle, diffused shadow (0px 4px 6px -1px rgba(0, 0, 0, 0.05)) to lift them from the background.
3. **Interactive Level (2):** Buttons and active dropdowns use a slightly more pronounced shadow upon hover to indicate interactivity.
4. **Overlay Level (3):** Modals and pop-overs use a deep, high-blur shadow with a 20% opacity neutral tint to focus user attention on critical tasks like "Konfirmasi KPRS."

## Shapes

The shape language is approachable yet professional. A **Rounded (8px-12px)** strategy is applied consistently:

- **Standard Buttons & Inputs:** 8px (0.5rem) border-radius.
- **Cards & Containers:** 12px (0.75rem) border-radius.
- **Status Badges (Chips):** Fully pill-shaped (9999px) to distinguish them from interactive buttons.

This moderate rounding softens the institutional feel, making the software feel modern and user-friendly on both touch and pointer devices.

## Components

- **Buttons:** Primary buttons are solid Deep Institutional Blue. Secondary buttons use an outline style with a 1px border. "Simpan" (Save) should always be primary, while "Batal" (Cancel) is ghost or secondary.
- **Inputs:** Form fields must have explicit labels in Bahasa Indonesia (e.g., "Nama Lengkap", "NIM"). Use a 1px gray border (#D1D5DB) that shifts to Primary Blue on focus.
- **Chips/Badges:** Small, rounded-pill indicators for status. Example: "Lunas" (Success Green background at 10% opacity with 100% opacity text).
- **Data Tables (SIAKAD):** Essential for grades and course lists. Use a flat style with subtle horizontal dividers and a light-gray header background.
- **Progress Steppers (PMB):** A horizontal stepper for registration stages (Biodata -> Berkas -> Pembayaran -> Seleksi).
- **Alerts:** Inline banners at the top of forms for important announcements or missing requirements.