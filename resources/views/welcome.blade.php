<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ - Ù…Ù†ØµØ© Ù…ØªÙƒØ§Ù…Ù„Ø© Ù„Ø¥Ø¯Ø§Ø±Ø© Ø®Ø¯Ù…Ø§Øª Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù…</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green-900: #052e16;
            --green-800: #054F31;
            --green-700: #15803d;
            --green-600: #16a34a;
            --green-500: #22c55e;
            --green-400: #4ade80;
            --green-100: #dcfce7;
            --green-50:  #f0fdf4;
            --gold:      #d4af37;
            --text-dark: #0f1a0f;
            --text-mid:  #374151;
            --text-light:#6b7280;
            --white:     #ffffff;
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
            --shadow-lg: 0 20px 60px -10px rgba(5,79,49,.25);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Tajawal', sans-serif;
            direction: rtl;
            background: var(--white);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* â”€â”€ Utility â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        .btn {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .75rem 2rem; border-radius: 50px; font-size: 1rem;
            font-weight: 700; font-family: 'Tajawal', sans-serif;
            cursor: pointer; border: 2px solid transparent;
            transition: all .3s ease; text-decoration: none;
        }
        .btn-primary { background: var(--white); color: var(--green-800); }
        .btn-primary:hover { background: var(--green-100); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(255,255,255,.3); }
        .btn-outline { background: transparent; color: var(--white); border-color: rgba(255,255,255,.6); }
        .btn-outline:hover { background: rgba(255,255,255,.1); transform: translateY(-2px); }
        .btn-green { background: var(--green-700); color: var(--white); }
        .btn-green:hover { background: var(--green-800); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(5,79,49,.4); }
        .section-badge {
            display: inline-flex; align-items: center; gap: .4rem;
            background: var(--green-100); color: var(--green-800);
            padding: .4rem 1.2rem; border-radius: 50px;
            font-size: .85rem; font-weight: 700; margin-bottom: 1rem;
        }
        .section-title { font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 800; color: var(--text-dark); line-height: 1.3; margin-bottom: 1rem; }
        .section-sub { font-size: 1.05rem; color: var(--text-light); line-height: 1.8; max-width: 600px; }

        /* â”€â”€ Navbar â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        nav {
            position: fixed; top: 0; width: 100%; z-index: 1000;
            background: rgba(5,79,49,.97); backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,.1);
            transition: all .3s ease;
        }
        nav.scrolled { box-shadow: 0 4px 30px rgba(5,79,49,.4); }
        .nav-inner {
            display: flex; align-items: center; justify-content: space-between;
            height: 70px;
        }
        .nav-logo {
            display: flex; align-items: center; gap: .75rem;
            text-decoration: none;
        }
        .logo-icon {
            width: 42px; height: 42px; background: var(--white);
            border-radius: 10px; display: flex; align-items: center;
            justify-content: center; font-size: 1.3rem; font-weight: 900;
            color: var(--green-800); flex-shrink: 0;
        }
        .logo-text { color: var(--white); font-size: 1.25rem; font-weight: 800; }
        .logo-sub { color: rgba(255,255,255,.6); font-size: .7rem; }
        .nav-links { display: flex; align-items: center; gap: .25rem; list-style: none; }
        .nav-links a {
            color: rgba(255,255,255,.85); text-decoration: none;
            font-size: .9rem; font-weight: 500; padding: .5rem .9rem;
            border-radius: 8px; transition: all .2s;
        }
        .nav-links a:hover, .nav-links a.active { color: var(--white); background: rgba(255,255,255,.12); }
        .nav-cta { display: flex; align-items: center; gap: .75rem; }
        .nav-btn {
            padding: .55rem 1.4rem; border-radius: 50px; font-size: .9rem;
            font-weight: 700; cursor: pointer; text-decoration: none;
            font-family: 'Tajawal', sans-serif; transition: all .3s;
        }
        .nav-btn-outline { color: var(--white); border: 1.5px solid rgba(255,255,255,.5); background: transparent; }
        .nav-btn-outline:hover { background: rgba(255,255,255,.1); }
        .nav-btn-solid { background: var(--white); color: var(--green-800); border: none; }
        .nav-btn-solid:hover { background: var(--green-100); transform: translateY(-1px); }
        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 4px; }
        .hamburger span { display: block; width: 24px; height: 2px; background: var(--white); border-radius: 2px; transition: all .3s; }

        /* â”€â”€ Hero â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        .hero {
            min-height: 100vh; padding: 100px 0 60px;
            background: linear-gradient(135deg, var(--green-900) 0%, var(--green-800) 40%, var(--green-700) 100%);
            position: relative; overflow: hidden;
            display: flex; align-items: center;
        }
        .hero::before {
            content: ''; position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .hero-blob {
            position: absolute; border-radius: 50%; filter: blur(80px); opacity: .15;
        }
        .hero-blob-1 { width: 600px; height: 600px; background: var(--green-400); top: -200px; left: -200px; }
        .hero-blob-2 { width: 400px; height: 400px; background: var(--gold); bottom: -100px; right: -100px; }
        .hero-inner {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 4rem; align-items: center; position: relative; z-index: 1;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(255,255,255,.12); color: var(--white);
            border: 1px solid rgba(255,255,255,.2); padding: .45rem 1.2rem;
            border-radius: 50px; font-size: .85rem; font-weight: 600;
            margin-bottom: 1.5rem; backdrop-filter: blur(4px);
        }
        .hero-badge span { width: 8px; height: 8px; background: var(--green-400); border-radius: 50%; animation: pulse 2s infinite; }
        .hero-title { font-size: clamp(2.2rem, 5vw, 3.5rem); font-weight: 900; color: var(--white); line-height: 1.2; margin-bottom: 1.25rem; }
        .hero-title .highlight { color: var(--green-400); }
        .hero-desc { font-size: 1.1rem; color: rgba(255,255,255,.8); line-height: 1.9; margin-bottom: 2rem; }
        .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 3rem; }
        .hero-stats { display: flex; gap: 2rem; flex-wrap: wrap; }
        .stat-item { text-align: center; }
        .stat-num { font-size: 1.8rem; font-weight: 900; color: var(--white); display: block; }
        .stat-label { font-size: .8rem; color: rgba(255,255,255,.65); }
        .stat-divider { width: 1px; background: rgba(255,255,255,.2); }
        .hero-visual { position: relative; }
        .dashboard-mockup {
            background: var(--white); border-radius: 16px;
            box-shadow: 0 40px 100px rgba(0,0,0,.35);
            overflow: hidden; transform: perspective(1000px) rotateY(-6deg) rotateX(3deg);
            transition: transform .5s ease;
        }
        .dashboard-mockup:hover { transform: perspective(1000px) rotateY(0deg) rotateX(0deg); }
        .mockup-header { background: var(--green-800); padding: 1rem 1.5rem; display: flex; align-items: center; gap: 1rem; }
        .mockup-dots { display: flex; gap: .4rem; }
        .mockup-dots span { width: 10px; height: 10px; border-radius: 50%; }
        .mockup-dots span:nth-child(1) { background: #ff5f56; }
        .mockup-dots span:nth-child(2) { background: #febc2e; }
        .mockup-dots span:nth-child(3) { background: #28c840; }
        .mockup-title-bar { color: rgba(255,255,255,.7); font-size: .8rem; flex: 1; text-align: center; }
        .mockup-body { padding: 1.5rem; background: #f8fafc; }
        .mockup-cards { display: grid; grid-template-columns: repeat(3,1fr); gap: .75rem; margin-bottom: 1rem; }
        .mockup-card { background: var(--white); border-radius: 10px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
        .mockup-card-icon { width: 32px; height: 32px; border-radius: 8px; margin-bottom: .5rem; }
        .mockup-card-num { font-size: 1.3rem; font-weight: 800; color: var(--text-dark); }
        .mockup-card-lbl { font-size: .7rem; color: var(--text-light); }
        .mockup-chart { background: var(--white); border-radius: 10px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
        .chart-bar-row { display: flex; align-items: center; gap: .5rem; margin-bottom: .4rem; }
        .chart-label { font-size: .65rem; color: var(--text-light); width: 50px; text-align: left; }
        .chart-bar-wrap { flex: 1; background: #f1f5f9; border-radius: 4px; height: 8px; }
        .chart-bar { height: 8px; border-radius: 4px; background: var(--green-600); }
        .floating-badge {
            position: absolute; background: var(--white); border-radius: 12px;
            padding: .7rem 1rem; box-shadow: 0 8px 30px rgba(0,0,0,.15);
            display: flex; align-items: center; gap: .6rem; font-size: .8rem;
            font-weight: 700; animation: float 4s ease-in-out infinite;
        }
        .floating-badge.badge-a { top: -20px; right: -30px; animation-delay: 0s; }
        .floating-badge.badge-b { bottom: 20px; left: -30px; animation-delay: 2s; }
        .badge-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1rem; }

        /* â”€â”€ About â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        .about { padding: 100px 0; background: var(--white); }
        .about-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: start; }
        .about-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .about-card {
            background: var(--white); border: 1.5px solid #e5e7eb;
            border-radius: var(--radius-lg); padding: 1.5rem;
            transition: all .3s ease; position: relative; overflow: hidden;
        }
        .about-card::before { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, var(--green-50), transparent); opacity: 0; transition: opacity .3s; }
        .about-card:hover { border-color: var(--green-500); transform: translateY(-4px); box-shadow: var(--shadow-lg); }
        .about-card:hover::before { opacity: 1; }
        .card-icon-wrap { width: 52px; height: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1rem; }
        .card-title { font-size: 1rem; font-weight: 700; color: var(--text-dark); margin-bottom: .4rem; }
        .card-desc { font-size: .85rem; color: var(--text-light); line-height: 1.7; }

        /* â”€â”€ Features â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        .features { padding: 100px 0; background: var(--green-50); }
        .features-header { text-align: center; margin-bottom: 4rem; }
        .features-header .section-sub { margin: 0 auto; }
        .features-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; }
        .feature-card {
            background: var(--white); border-radius: var(--radius-xl);
            padding: 2rem; transition: all .3s ease;
            border: 1.5px solid transparent; position: relative; overflow: hidden;
        }
        .feature-card::after { content: ''; position: absolute; bottom: 0; right: 0; width: 80px; height: 80px; background: var(--green-50); border-radius: 50%; transform: translate(30px,30px); transition: all .4s; }
        .feature-card:hover { border-color: var(--green-400); transform: translateY(-6px); box-shadow: var(--shadow-lg); }
        .feature-card:hover::after { width: 120px; height: 120px; background: var(--green-100); }
        .feature-icon { width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin-bottom: 1.25rem; position: relative; z-index: 1; }
        .feature-title { font-size: 1.1rem; font-weight: 700; color: var(--text-dark); margin-bottom: .6rem; }
        .feature-desc { font-size: .9rem; color: var(--text-light); line-height: 1.75; }

        /* â”€â”€ How it Works â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        .how { padding: 100px 0; background: var(--white); }
        .how-header { text-align: center; margin-bottom: 5rem; }
        .how-steps { display: flex; gap: 0; position: relative; }
        .how-steps::before { content: ''; position: absolute; top: 40px; right: 10%; left: 10%; height: 2px; background: linear-gradient(to left, #bbf7d0, var(--green-500)); z-index: 0; }
        .how-step { flex: 1; text-align: center; padding: 0 1rem; position: relative; z-index: 1; }
        .step-num {
            width: 80px; height: 80px; border-radius: 50%; background: var(--green-800);
            color: var(--white); font-size: 1.5rem; font-weight: 900;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem; box-shadow: 0 8px 25px rgba(5,79,49,.35);
            transition: all .3s; border: 4px solid var(--white); outline: 2px solid var(--green-800);
        }
        .how-step:hover .step-num { background: var(--green-600); transform: scale(1.1); }
        .step-title { font-size: 1rem; font-weight: 700; color: var(--text-dark); margin-bottom: .5rem; }
        .step-desc { font-size: .85rem; color: var(--text-light); line-height: 1.7; }

        /* â”€â”€ Audience â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        .audience { padding: 100px 0; background: var(--green-900); position: relative; overflow: hidden; }
        .audience::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
        .audience-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; position: relative; z-index: 1; }
        .audience-panel { background: rgba(255,255,255,.06); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,.1); border-radius: var(--radius-xl); padding: 2.5rem; }
        .audience-panel-title { display: flex; align-items: center; gap: 1rem; font-size: 1.4rem; font-weight: 800; color: var(--white); margin-bottom: .75rem; padding-bottom: 1.25rem; border-bottom: 1px solid rgba(255,255,255,.1); }
        .audience-panel-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .audience-list { list-style: none; display: flex; flex-direction: column; gap: .9rem; margin-bottom: 2rem; }
        .audience-list li { display: flex; align-items: flex-start; gap: .75rem; color: rgba(255,255,255,.8); font-size: .95rem; line-height: 1.6; }
        .check-icon { width: 20px; height: 20px; border-radius: 50%; background: var(--green-600); display: flex; align-items: center; justify-content: center; font-size: .65rem; color: var(--white); flex-shrink: 0; margin-top: .15rem; }

        /* â”€â”€ Testimonials â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        .testimonials { padding: 100px 0; background: #f8fafc; }
        .testimonials-header { text-align: center; margin-bottom: 4rem; }
        .testimonials-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; }
        .testimonial-card { background: var(--white); border-radius: var(--radius-xl); padding: 2rem; border: 1.5px solid #e5e7eb; transition: all .3s; }
        .testimonial-card:hover { border-color: var(--green-400); box-shadow: var(--shadow-lg); transform: translateY(-4px); }
        .stars { color: var(--gold); font-size: 1rem; margin-bottom: 1rem; letter-spacing: 2px; }
        .testimonial-text { font-size: .95rem; color: var(--text-mid); line-height: 1.8; margin-bottom: 1.5rem; font-style: italic; }
        .testimonial-author { display: flex; align-items: center; gap: .75rem; }
        .author-avatar { width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; font-weight: 700; color: var(--white); }
        .author-name { font-size: .95rem; font-weight: 700; color: var(--text-dark); }
        .author-role { font-size: .8rem; color: var(--text-light); }

        /* â”€â”€ CTA â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        .cta {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--green-800), var(--green-700));
            position: relative; overflow: hidden;
        }
        .cta::before { content: ''; position: absolute; top: -100px; left: -100px; width: 400px; height: 400px; background: var(--green-400); opacity: .08; border-radius: 50%; }
        .cta::after { content: ''; position: absolute; bottom: -100px; right: -100px; width: 300px; height: 300px; background: var(--gold); opacity: .08; border-radius: 50%; }
        .cta-inner { text-align: center; position: relative; z-index: 1; }
        .cta-title { font-size: clamp(2rem,4vw,3rem); font-weight: 900; color: var(--white); margin-bottom: 1rem; }
        .cta-sub { font-size: 1.1rem; color: rgba(255,255,255,.8); margin-bottom: 2.5rem; line-height: 1.8; }
        .cta-actions { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }

        /* â”€â”€ Footer â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        footer { background: var(--green-900); padding: 60px 0 30px; color: rgba(255,255,255,.7); }
        .footer-inner { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 3rem; margin-bottom: 3rem; }
        .footer-desc { font-size: .9rem; line-height: 1.8; margin: 1rem 0 1.5rem; }
        .footer-social { display: flex; gap: .6rem; }
        .social-btn { width: 36px; height: 36px; background: rgba(255,255,255,.08); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: .9rem; text-decoration: none; color: var(--white); transition: all .2s; }
        .social-btn:hover { background: var(--green-700); }
        .footer-col h4 { color: var(--white); font-size: 1rem; font-weight: 700; margin-bottom: 1.25rem; }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: .6rem; }
        .footer-col a { color: rgba(255,255,255,.6); text-decoration: none; font-size: .9rem; transition: color .2s; }
        .footer-col a:hover { color: var(--green-400); }
        .footer-divider { border: none; border-top: 1px solid rgba(255,255,255,.08); margin-bottom: 1.5rem; }
        .footer-bottom { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
        .footer-bottom p { font-size: .85rem; }

        /* â”€â”€ Animations â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        @keyframes pulse { 0%,100%{transform:scale(1);opacity:1} 50%{transform:scale(1.4);opacity:.7} }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }
        @keyframes fadeInUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }
        .fade-in-up { animation: fadeInUp .7s ease forwards; }
        .delay-1 { animation-delay: .15s; opacity: 0; }
        .delay-2 { animation-delay: .3s;  opacity: 0; }
        .delay-3 { animation-delay: .45s; opacity: 0; }
        .delay-4 { animation-delay: .6s;  opacity: 0; }

        /* â”€â”€ Responsive â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        @media (max-width: 1024px) {
            .features-grid { grid-template-columns: repeat(2,1fr); }
            .testimonials-grid { grid-template-columns: repeat(2,1fr); }
            .footer-inner { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            .nav-links, .nav-cta { display: none; }
            .hamburger { display: flex; }
            .hero-inner { grid-template-columns: 1fr; text-align: center; }
            .hero-visual { display: none; }
            .hero-actions { justify-content: center; }
            .hero-stats { justify-content: center; }
            .about-inner { grid-template-columns: 1fr; }
            .features-grid { grid-template-columns: 1fr; }
            .how-steps { flex-direction: column; gap: 2rem; }
            .how-steps::before { display: none; }
            .audience-inner { grid-template-columns: 1fr; }
            .testimonials-grid { grid-template-columns: 1fr; }
            .footer-inner { grid-template-columns: 1fr; gap: 2rem; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }
    </style>

</head>
<body>

<!-- â•â• NAVBAR â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<nav id="navbar">
    <div class="container">
        <div class="nav-inner">
            <a href="#" class="nav-logo">
                <div class="logo-icon">Ù…</div>
                <div>
                    <div class="logo-text">Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ</div>
                    <div class="logo-sub">Ù…Ù†ØµØ© Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù… Ø§Ù„Ø°ÙƒÙŠØ©</div>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="#" class="active">Ø§Ù„Ø±Ø¦ÙŠØ³ÙŠØ©</a></li>
                <li><a href="#about">Ø¹Ù† Ø§Ù„ØªØ·Ø¨ÙŠÙ‚</a></li>
                <li><a href="#features">Ø§Ù„Ù…Ù…ÙŠØ²Ø§Øª</a></li>
                <li><a href="#how">ÙƒÙŠÙ ÙŠØ¹Ù…Ù„</a></li>
                <li><a href="#audience">Ù„Ù„Ù…ÙƒØ§ØªØ¨</a></li>
                <li><a href="#contact">ØªÙˆØ§ØµÙ„ Ù…Ø¹Ù†Ø§</a></li>
            </ul>

            <div class="nav-cta">
                <a href="/office/login" class="nav-btn nav-btn-outline">Ø¯Ø®ÙˆÙ„ Ø§Ù„Ù…ÙƒØªØ¨</a>
                <a href="/admin/login" class="nav-btn nav-btn-solid">Ù„ÙˆØ­Ø© Ø§Ù„ØªØ­ÙƒÙ…</a>
            </div>

            <div class="hamburger" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>
    </div>
</nav>

<!-- â•â• HERO â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section class="hero" id="home">
    <div class="hero-blob hero-blob-1"></div>
    <div class="hero-blob hero-blob-2"></div>

    <div class="container">
        <div class="hero-inner">
            <div>
                <div class="hero-badge fade-in-up">
                    <span></span>
                    Ù…Ù†ØµØ© Ù…ÙˆØ«ÙˆÙ‚Ø© Ù„Ø£ÙƒØ«Ø± Ù…Ù† 500 Ù…ÙƒØªØ¨
                </div>

                <h1 class="hero-title fade-in-up delay-1">
                    Ù…Ù†ØµØ© Ù…ØªÙƒØ§Ù…Ù„Ø©<br>
                    Ù„Ø¥Ø¯Ø§Ø±Ø© <span class="highlight">Ø®Ø¯Ù…Ø§Øª Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù…</span>
                </h1>

                <p class="hero-desc fade-in-up delay-2">
                    Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ Ø³Ø§Ø¹Ø¯ Ù…ÙƒØ§ØªØ¨ Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù… ÙˆØ§Ù„Ù…Ø³ØªØ®Ø¯Ù…ÙŠÙ† ÙÙŠ Ù…Ù†Ø¸ÙˆÙ…Ø© ÙˆØ§Ø­Ø¯Ø© ØªØ¶Ù… Ø¬Ù…ÙŠØ¹ Ø®Ø¯Ù…Ø§Øª
                    ÙˆÙ…ØªØ§Ø¨Ø¹Ø© Ø§Ù„Ø­Ø§Ù„Ø§Øª ÙˆØªÙ†Ø¸ÙŠÙ… Ø§Ù„Ø¨ÙŠØ§Ù†Ø§Øª ÙˆØ§Ù„Ø§Ø·Ù„Ø§Ø¹ Ø¹Ù„Ù‰ Ø§Ù„ØªÙ‚Ø§Ø±ÙŠØ± Ø¨Ø³Ù‡ÙˆÙ„Ø© ÙˆÙƒÙØ§Ø¡Ø© Ø¹Ø§Ù„ÙŠØ©.
                </p>

                <div class="hero-actions fade-in-up delay-3">
                    <a href="#" class="btn btn-primary">ðŸš€ Ø§Ø¨Ø¯Ø£ Ù…Ø¬Ø§Ù†Ø§Ù‹</a>
                    <a href="#about" class="btn btn-outline">ØªØ¹Ø±Ù Ø¹Ù„Ù‰ Ø§Ù„Ù…Ø²ÙŠØ¯</a>
                </div>

                <div class="hero-stats fade-in-up delay-4">
                    <div class="stat-item">
                        <span class="stat-num">+500</span>
                        <span class="stat-label">Ù…ÙƒØªØ¨ Ø§Ø³ØªÙ‚Ø¯Ø§Ù…</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">+10K</span>
                        <span class="stat-label">Ø³ÙŠØ±Ø© Ø°Ø§ØªÙŠØ©</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">99%</span>
                        <span class="stat-label">Ø±Ø¶Ø§ Ø§Ù„Ø¹Ù…Ù„Ø§Ø¡</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">24/7</span>
                        <span class="stat-label">Ø¯Ø¹Ù… ÙÙ†ÙŠ</span>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="floating-badge badge-a">
                    <div class="badge-icon" style="background:#dcfce7">âœ…</div>
                    <div>
                        <div style="color:#054F31;font-size:.85rem">Ø·Ù„Ø¨ Ø¬Ø¯ÙŠØ¯</div>
                        <div style="color:#6b7280;font-size:.7rem">ØªÙ…Øª Ø§Ù„Ù…ÙˆØ§ÙÙ‚Ø©</div>
                    </div>
                </div>

                <div class="dashboard-mockup">
                    <div class="mockup-header">
                        <div class="mockup-dots"><span></span><span></span><span></span></div>
                        <div class="mockup-title-bar">Ù„ÙˆØ­Ø© ØªØ­ÙƒÙ… - Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ</div>
                    </div>
                    <div class="mockup-body">
                        <div class="mockup-cards">
                            <div class="mockup-card">
                                <div class="mockup-card-icon" style="background:#dcfce7">ðŸ‘¥</div>
                                <div class="mockup-card-num" style="color:#054F31">248</div>
                                <div class="mockup-card-lbl">Ø¥Ø¬Ù…Ø§Ù„ÙŠ Ø§Ù„Ø·Ù„Ø¨Ø§Øª</div>
                            </div>
                            <div class="mockup-card">
                                <div class="mockup-card-icon" style="background:#fef3c7">ðŸ“‹</div>
                                <div class="mockup-card-num" style="color:#92400e">64</div>
                                <div class="mockup-card-lbl">Ù‚ÙŠØ¯ Ø§Ù„Ù…Ø¹Ø§Ù„Ø¬Ø©</div>
                            </div>
                            <div class="mockup-card">
                                <div class="mockup-card-icon" style="background:#e0f2fe">âœ”ï¸</div>
                                <div class="mockup-card-num" style="color:#0369a1">184</div>
                                <div class="mockup-card-lbl">Ù…ÙƒØªÙ…Ù„Ø©</div>
                            </div>
                        </div>
                        <div class="mockup-chart">
                            <div style="font-size:.75rem;font-weight:700;color:#374151;margin-bottom:.75rem">Ù†Ø´Ø§Ø· Ø§Ù„Ø£Ø³Ø¨ÙˆØ¹</div>
                            <div class="chart-bar-row">
                                <div class="chart-label">Ø§Ù„Ø£Ø­Ø¯</div>
                                <div class="chart-bar-wrap"><div class="chart-bar" style="width:75%"></div></div>
                            </div>
                            <div class="chart-bar-row">
                                <div class="chart-label">Ø§Ù„Ø§Ø«Ù†ÙŠÙ†</div>
                                <div class="chart-bar-wrap"><div class="chart-bar" style="width:90%"></div></div>
                            </div>
                            <div class="chart-bar-row">
                                <div class="chart-label">Ø§Ù„Ø«Ù„Ø§Ø«Ø§Ø¡</div>
                                <div class="chart-bar-wrap"><div class="chart-bar" style="width:60%"></div></div>
                            </div>
                            <div class="chart-bar-row">
                                <div class="chart-label">Ø§Ù„Ø£Ø±Ø¨Ø¹Ø§Ø¡</div>
                                <div class="chart-bar-wrap"><div class="chart-bar" style="width:85%"></div></div>
                            </div>
                            <div class="chart-bar-row">
                                <div class="chart-label">Ø§Ù„Ø®Ù…ÙŠØ³</div>
                                <div class="chart-bar-wrap"><div class="chart-bar" style="width:45%"></div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="floating-badge badge-b">
                    <div class="badge-icon" style="background:#fef3c7">â­</div>
                    <div>
                        <div style="color:#054F31;font-size:.85rem">ØªÙ‚ÙŠÙŠÙ… Ù…Ù…ØªØ§Ø²</div>
                        <div style="color:#6b7280;font-size:.7rem">4.9 / 5.0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- â•â• ABOUT â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section class="about" id="about">
    <div class="container">
        <div class="about-inner">
            <div>
                <div class="section-badge">âœ¨ Ø¹Ù† Ø§Ù„ØªØ·Ø¨ÙŠÙ‚</div>
                <h2 class="section-title">Ù†Ø¸Ø§Ù… Ø´Ø§Ù…Ù„ Ù„ÙƒÙ„ Ù…Ø§ ØªØ­ØªØ§Ø¬Ù‡</h2>
                <p class="section-sub">
                    Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ Ù‡Ùˆ Ù…Ù†ØµØ© ØªÙ‚Ù†ÙŠØ© Ù…ØªØ·ÙˆØ±Ø© ØªØ±Ø¨Ø· Ù…ÙƒØ§ØªØ¨ Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù… ÙˆØ§Ù„Ù…Ø³ØªØ®Ø¯Ù…ÙŠÙ† ÙÙŠ Ù…Ù†Ø¸ÙˆÙ…Ø© ÙˆØ§Ø­Ø¯Ø©
                    Ù„ØªÙ‚Ø¯ÙŠÙ… Ø®Ø¯Ù…Ø§Øª Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù… Ù…Ù† ØªÙ‚Ø¯ÙŠÙ… Ø§Ù„Ø·Ù„Ø¨ Ø­ØªÙ‰ Ø¥ØªÙ…Ø§Ù… Ø§Ù„Ø®Ø¯Ù…Ø© Ø¨ÙƒÙ„ Ø³Ù‡ÙˆÙ„Ø© ÙˆØ§Ø­ØªØ±Ø§ÙÙŠØ©.
                </p>
                <div style="margin-top:2rem;display:flex;flex-direction:column;gap:.75rem">
                    <div style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">âœ“</div>
                        ÙˆØ§Ø¬Ù‡Ø© Ø³Ù‡Ù„Ø© Ø§Ù„Ø§Ø³ØªØ®Ø¯Ø§Ù… Ø¨Ø§Ù„Ù„ØºØ© Ø§Ù„Ø¹Ø±Ø¨ÙŠØ© Ø§Ù„ÙƒØ§Ù…Ù„Ø©
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">âœ“</div>
                        ØªÙ‚Ø§Ø±ÙŠØ± ÙˆÙ„ÙˆØ­Ø§Øª Ø¥Ø­ØµØ§Ø¦ÙŠØ© ÙÙˆØ±ÙŠØ© ÙˆÙ…ØªÙƒØ§Ù…Ù„Ø©
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">âœ“</div>
                        Ø¯Ø¹Ù… ÙƒØ§Ù…Ù„ Ù„Ù„Ø£Ø¬Ù‡Ø²Ø© Ø§Ù„Ù…Ø­Ù…ÙˆÙ„Ø© ÙˆØ§Ù„Ø­Ø§Ø³ÙˆØ¨
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">âœ“</div>
                        Ø­Ù…Ø§ÙŠØ© Ø¹Ø§Ù„ÙŠØ© Ù„Ù„Ø¨ÙŠØ§Ù†Ø§Øª ÙˆØ®ØµÙˆØµÙŠØ© ØªØ§Ù…Ø©
                    </div>
                </div>
            </div>

            <div class="about-cards">
                <div class="about-card">
                    <div class="card-icon-wrap" style="background:#dcfce7">ðŸ“‹</div>
                    <div class="card-title">Ø¥Ø¯Ø§Ø±Ø© Ø§Ù„Ø·Ù„Ø¨Ø§Øª</div>
                    <div class="card-desc">Ù…ØªØ§Ø¨Ø¹Ø© ÙƒÙ„ Ø·Ù„Ø¨Ø§Øª Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù… Ù…Ù† Ø§Ù„Ø¨Ø¯Ø§ÙŠØ© Ø¥Ù„Ù‰ Ø§Ù„Ø¥ØªÙ…Ø§Ù… Ø§Ù„Ù†Ù‡Ø§Ø¦ÙŠ</div>
                </div>
                <div class="about-card">
                    <div class="card-icon-wrap" style="background:#dbeafe">ðŸ—„ï¸</div>
                    <div class="card-title">Ø¥Ø¯Ø§Ø±Ø© Ø§Ù„Ø¨ÙŠØ§Ù†Ø§Øª</div>
                    <div class="card-desc">Ù‚Ø§Ø¹Ø¯Ø© Ø¨ÙŠØ§Ù†Ø§Øª Ù…ÙˆØ­Ø¯Ø© Ù„ÙƒÙ„ Ø§Ù„Ù…Ø¹Ø§Ù…Ù„Ø§Øª ÙˆØ§Ù„ÙˆØ«Ø§Ø¦Ù‚ ÙˆØ§Ù„Ø³Ø¬Ù„Ø§Øª</div>
                </div>
                <div class="about-card">
                    <div class="card-icon-wrap" style="background:#fef3c7">ðŸ””</div>
                    <div class="card-title">Ù…ØªØ§Ø¨Ø¹Ø© Ø§Ù„Ø­Ø§Ù„Ø§Øª</div>
                    <div class="card-desc">Ø¥Ø´Ø¹Ø§Ø±Ø§Øª ÙÙˆØ±ÙŠØ© ÙˆØªØªØ¨Ø¹ Ù„Ø­Ø¸ÙŠ Ù„ÙƒÙ„ Ù…Ø±Ø­Ù„Ø© Ù…Ù† Ù…Ø±Ø§Ø­Ù„ Ø§Ù„Ø·Ù„Ø¨</div>
                </div>
                <div class="about-card">
                    <div class="card-icon-wrap" style="background:#fce7f3">ðŸ“Š</div>
                    <div class="card-title">Ø§Ù„ØªÙ‚Ø§Ø±ÙŠØ± ÙˆØ§Ù„Ø¥Ø´Ø¹Ø§Ø±Ø§Øª</div>
                    <div class="card-desc">ØªÙ‚Ø§Ø±ÙŠØ± ØªÙØµÙŠÙ„ÙŠØ© ÙˆØ¥Ø´Ø¹Ø§Ø±Ø§Øª Ø°ÙƒÙŠØ© ØªØ¨Ù‚ÙŠÙƒ Ø¹Ù„Ù‰ Ø§Ø·Ù„Ø§Ø¹ Ø¯Ø§Ø¦Ù…</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- â•â• FEATURES â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section class="features" id="features">
    <div class="container">
        <div class="features-header">
            <div class="section-badge">âš¡ Ù…Ù…ÙŠØ²Ø§Øª Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ</div>
            <h2 class="section-title">ÙƒÙ„ Ù…Ø§ ØªØ­ØªØ§Ø¬Ù‡ ÙÙŠ Ù…ÙƒØ§Ù† ÙˆØ§Ø­Ø¯</h2>
            <p class="section-sub">Ù†ÙˆÙØ± Ù„Ùƒ Ø£Ø¯ÙˆØ§Øª Ù…ØªØ·ÙˆØ±Ø© ØªØ¬Ø¹Ù„ Ø¥Ø¯Ø§Ø±Ø© Ø£Ø¹Ù…Ø§Ù„ Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù… Ø£Ø³Ø±Ø¹ ÙˆØ£ÙƒØ«Ø± Ø¯Ù‚Ø© ÙˆÙƒÙØ§Ø¡Ø©</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon" style="background:#dcfce7">ðŸ‘¥</div>
                <div class="feature-title">Ø¥Ø¯Ø§Ø±Ø© Ø§Ù„Ù…Ø³ØªØ®Ø¯Ù…ÙŠÙ† ÙˆØ§Ù„ØµÙ„Ø§Ø­ÙŠØ§Øª</div>
                <div class="feature-desc">ØªØ­ÙƒÙ… ÙƒØ§Ù…Ù„ ÙÙŠ Ø§Ù„Ø£Ø¯ÙˆØ§Ø± ÙˆØ§Ù„ØµÙ„Ø§Ø­ÙŠØ§Øª Ù„ÙƒÙ„ ÙØ±Ø¯ ÙÙŠ ÙØ±ÙŠÙ‚Ùƒ Ø¨Ù…Ø±ÙˆÙ†Ø© Ø¹Ø§Ù„ÙŠØ©</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#dbeafe">ðŸ“Š</div>
                <div class="feature-title">Ù„ÙˆØ­Ø© ØªØ­ÙƒÙ… Ù…ØªÙƒØ§Ù…Ù„Ø©</div>
                <div class="feature-desc">Ø¥Ø­ØµØ§Ø¡Ø§Øª ÙˆÙ…Ø¤Ø´Ø±Ø§Øª Ø£Ø¯Ø§Ø¡ ÙÙˆØ±ÙŠØ© ØªØ³Ø§Ø¹Ø¯Ùƒ Ø¹Ù„Ù‰ Ø§ØªØ®Ø§Ø° Ù‚Ø±Ø§Ø±Ø§Øª ØµØ­ÙŠØ­Ø©</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#fef3c7">âš¡</div>
                <div class="feature-title">Ø¥Ø¯Ø§Ø±Ø© Ø³ÙŠØ± Ø§Ù„Ø¹Ù…Ù„</div>
                <div class="feature-desc">Ø£ØªÙ…ØªØ© Ø°ÙƒÙŠØ© Ù„Ø¹Ù…Ù„ÙŠØ§Øª Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù… ØªÙ‚Ù„Ù„ Ø§Ù„Ø£Ø®Ø·Ø§Ø¡ ÙˆØªÙˆÙØ± Ø§Ù„ÙˆÙ‚Øª ÙˆØ§Ù„Ø¬Ù‡Ø¯</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#fce7f3">ðŸ””</div>
                <div class="feature-title">Ø¥Ø´Ø¹Ø§Ø±Ø§Øª ÙˆØªÙ†Ø¨ÙŠÙ‡Ø§Øª Ø°ÙƒÙŠØ©</div>
                <div class="feature-desc">Ø§Ø¨Ù‚ Ø¹Ù„Ù‰ Ø§Ø·Ù„Ø§Ø¹ Ø¯Ø§Ø¦Ù… Ø¨ÙƒÙ„ Ø§Ù„Ù…Ø³ØªØ¬Ø¯Ø§Øª ÙˆØ§Ù„ØªØ­Ø¯ÙŠØ«Ø§Øª ÙÙŠ Ø§Ù„ÙˆÙ‚Øª Ø§Ù„ÙØ¹Ù„ÙŠ</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#f0fdf4">ðŸ“ˆ</div>
                <div class="feature-title">ØªÙ‚Ø§Ø±ÙŠØ± ÙˆØ¥Ø­ØµØ§Ø¦ÙŠØ§Øª Ù…ÙØµÙ„Ø©</div>
                <div class="feature-desc">ØªØ­Ù„ÙŠÙ„Ø§Øª Ù…ØªØ¹Ù…Ù‚Ø© ÙˆØªÙ‚Ø§Ø±ÙŠØ± Ø´Ø§Ù…Ù„Ø© Ù„ÙƒÙ„ Ø¬ÙˆØ§Ù†Ø¨ Ø¹Ù…Ù„Ùƒ ÙˆØ£Ø¯Ø§Ø¦Ùƒ</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#ede9fe">ðŸ›¡ï¸</div>
                <div class="feature-title">Ø¯Ø¹Ù… ÙÙ†ÙŠ Ù…ØªÙˆÙØ±</div>
                <div class="feature-desc">ÙØ±ÙŠÙ‚ Ø¯Ø¹Ù… Ù…ØªØ®ØµØµ Ø¹Ù„Ù‰ Ù…Ø¯Ø§Ø± Ø§Ù„Ø³Ø§Ø¹Ø© Ù„Ù…Ø³Ø§Ø¹Ø¯ØªÙƒ ÙÙŠ Ø£ÙŠ ÙˆÙ‚Øª ØªØ­ØªØ§Ø¬Ù‡</div>
            </div>
        </div>
    </div>
</section>

<!-- â•â• HOW IT WORKS â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section class="how" id="how">
    <div class="container">
        <div class="how-header">
            <div class="section-badge">ðŸ”„ ÙƒÙŠÙ ÙŠØ¹Ù…Ù„ Ø§Ù„Ù†Ø¸Ø§Ù…ØŸ</div>
            <h2 class="section-title">Ø®Ø·ÙˆØ§Øª Ø¨Ø³ÙŠØ·Ø© Ù„Ù„Ø¨Ø¯Ø§ÙŠØ©</h2>
            <p class="section-sub" style="margin:0 auto">Ø®Ù…Ø³ Ø®Ø·ÙˆØ§Øª Ø³Ù‡Ù„Ø© ØªØ¨Ø¯Ø£ Ø¨Ù‡Ø§ Ø±Ø­Ù„ØªÙƒ Ù…Ø¹ Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ</p>
        </div>
        <div class="how-steps">
            <div class="how-step">
                <div class="step-num">01</div>
                <div class="step-title">ØªÙ‚Ø¯ÙŠÙ… Ø§Ù„Ø·Ù„Ø¨</div>
                <div class="step-desc">ÙŠÙ‚Ø¯Ù… Ø§Ù„Ù…Ø³ØªØ®Ø¯Ù… Ø·Ù„Ø¨Ù‡ Ø¨ÙƒÙ„ Ø³Ù‡ÙˆÙ„Ø© Ø¹Ø¨Ø± Ø§Ù„Ù…Ù†ØµØ©</div>
            </div>
            <div class="how-step">
                <div class="step-num">02</div>
                <div class="step-title">Ø¯Ø±Ø§Ø³Ø© Ø§Ù„Ø·Ù„Ø¨</div>
                <div class="step-desc">ÙŠØ±Ø§Ø¬Ø¹ Ø§Ù„Ù…ÙƒØªØ¨ Ø§Ù„Ø·Ù„Ø¨ ÙˆÙŠÙ‚ÙŠÙ‘Ù… Ø§Ù„Ø§Ø­ØªÙŠØ§Ø¬Ø§Øª</div>
            </div>
            <div class="how-step">
                <div class="step-num">03</div>
                <div class="step-title">Ù…ØªØ§Ø¨Ø¹Ø© Ø§Ù„Ø­Ø§Ù„Ø©</div>
                <div class="step-desc">ØªØªØ¨Ø¹ Ù„Ø­Ø¸ÙŠ Ù„ÙƒÙ„ Ù…Ø±Ø­Ù„Ø© Ù…Ù† Ù…Ø±Ø§Ø­Ù„ Ø§Ù„Ù…Ø¹Ø§Ù„Ø¬Ø©</div>
            </div>
            <div class="how-step">
                <div class="step-num">04</div>
                <div class="step-title">Ø¥ØªÙ…Ø§Ù… Ø§Ù„Ø®Ø¯Ù…Ø©</div>
                <div class="step-desc">Ø¥ØªÙ…Ø§Ù… Ø¬Ù…ÙŠØ¹ Ø§Ù„Ø¥Ø¬Ø±Ø§Ø¡Ø§Øª ÙˆØ§Ø³ØªÙƒÙ…Ø§Ù„ Ø§Ù„Ù…Ø¹Ø§Ù…Ù„Ø§Øª</div>
            </div>
            <div class="how-step">
                <div class="step-num">05</div>
                <div class="step-title">Ø§Ù„ØªÙ‚Ø§Ø±ÙŠØ± ÙˆØ§Ù„ØªÙˆØµÙŠØ§Øª</div>
                <div class="step-desc">Ø§Ø³ØªÙ„Ø§Ù… Ø§Ù„ØªÙ‚Ø±ÙŠØ± Ø§Ù„Ù†Ù‡Ø§Ø¦ÙŠ ÙˆØªÙ‚ÙŠÙŠÙ… Ø§Ù„Ø®Ø¯Ù…Ø© Ø§Ù„Ù…Ù‚Ø¯Ù…Ø©</div>
            </div>
        </div>
    </div>
</section>

<!-- â•â• AUDIENCE â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section class="audience" id="audience">
    <div class="container">
        <div style="text-align:center;margin-bottom:4rem;position:relative;z-index:1">
            <div class="section-badge" style="background:rgba(255,255,255,.12);color:var(--white);border:1px solid rgba(255,255,255,.2)">ðŸ‘¥ Ù…Ù† ÙŠØ³ØªØ®Ø¯Ù… Ø§Ù„Ù†Ø¸Ø§Ù…</div>
            <h2 class="section-title" style="color:var(--white)">Ø­Ù„ Ø´Ø§Ù…Ù„ Ù„Ù„Ø¬Ù…ÙŠØ¹</h2>
        </div>
        <div class="audience-inner">
            <div class="audience-panel">
                <div class="audience-panel-title">
                    <div class="audience-panel-icon" style="background:rgba(34,197,94,.2)">ðŸ¢</div>
                    Ù„Ù„Ù…ÙƒØ§ØªØ¨
                </div>
                <ul class="audience-list">
                    <li><div class="check-icon">âœ“</div>Ù„ÙˆØ­Ø© ØªØ­ÙƒÙ… Ù…ØªÙƒØ§Ù…Ù„Ø© Ù„Ø¥Ø¯Ø§Ø±Ø© Ø¬Ù…ÙŠØ¹ Ø·Ù„Ø¨Ø§Øª Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù… ÙˆÙ…ØªØ§Ø¨Ø¹ØªÙ‡Ø§ Ù„Ø­Ø¸Ø© Ø¨Ù„Ø­Ø¸Ø©</li>
                    <li><div class="check-icon">âœ“</div>Ø£Ø¯ÙˆØ§Øª Ù…ØªØ·ÙˆØ±Ø© Ù„Ø±ÙØ¹ Ø§Ù„Ø³ÙŠØ± Ø§Ù„Ø°Ø§ØªÙŠØ© ÙˆØ¥Ø¯Ø§Ø±Ø© Ù‚Ø§Ø¹Ø¯Ø© Ø¨ÙŠØ§Ù†Ø§Øª Ø§Ù„Ø¹Ù…Ø§Ù„Ø©</li>
                    <li><div class="check-icon">âœ“</div>ØªÙ‚Ø§Ø±ÙŠØ± Ù…Ø§Ù„ÙŠØ© ÙˆØ¥Ø­ØµØ§Ø¦ÙŠØ© Ø´Ø§Ù…Ù„Ø© Ù„Ù…ØªØ§Ø¨Ø¹Ø© Ø£Ø¯Ø§Ø¡ Ø§Ù„Ù…ÙƒØªØ¨ ÙˆÙ†Ù…ÙˆÙ‡</li>
                    <li><div class="check-icon">âœ“</div>Ø¥Ø´Ø¹Ø§Ø±Ø§Øª ÙÙˆØ±ÙŠØ© Ù„Ù„Ø·Ù„Ø¨Ø§Øª Ø§Ù„Ø¬Ø¯ÙŠØ¯Ø© ÙˆØªØ­Ø¯ÙŠØ«Ø§Øª Ø­Ø§Ù„Ø© ÙƒÙ„ Ù…Ø¹Ø§Ù…Ù„Ø©</li>
                    <li><div class="check-icon">âœ“</div>Ø¥Ø¯Ø§Ø±Ø© Ø§Ù„Ø¹Ø±ÙˆØ¶ Ø§Ù„ØªØ±ÙˆÙŠØ¬ÙŠØ© ÙˆØ§Ù„ÙƒÙˆØ¨ÙˆÙ†Ø§Øª ÙˆØ®Ø·Ø· Ø§Ù„Ø§Ø´ØªØ±Ø§ÙƒØ§Øª Ø¨Ù…Ø±ÙˆÙ†Ø©</li>
                </ul>
                <a href="#" class="btn" style="background:var(--green-500);color:var(--white)">Ø§Ø¨Ø¯Ø£ Ù…Ø¹ Ù…ÙƒØªØ¨Ùƒ</a>
            </div>
            <div class="audience-panel">
                <div class="audience-panel-title">
                    <div class="audience-panel-icon" style="background:rgba(59,130,246,.2)">ðŸ‘¤</div>
                    Ù„Ù„Ù…Ø³ØªØ®Ø¯Ù…ÙŠÙ†
                </div>
                <ul class="audience-list">
                    <li><div class="check-icon">âœ“</div>ØªÙ‚Ø¯ÙŠÙ… Ø·Ù„Ø¨Ø§Øª Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù… Ø¨Ø´ÙƒÙ„ Ø³Ù‡Ù„ ÙˆØ³Ø±ÙŠØ¹ Ù…Ù† Ø£ÙŠ Ù…ÙƒØ§Ù† ÙˆØ£ÙŠ ÙˆÙ‚Øª</li>
                    <li><div class="check-icon">âœ“</div>ØªØµÙØ­ Ø§Ù„Ø³ÙŠØ± Ø§Ù„Ø°Ø§ØªÙŠØ© ÙˆØ§Ø®ØªÙŠØ§Ø± Ø£ÙØ¶Ù„ Ø§Ù„Ù…Ø±Ø´Ø­ÙŠÙ† Ø§Ù„Ù…Ù†Ø§Ø³Ø¨ÙŠÙ† Ù„Ø§Ø­ØªÙŠØ§Ø¬Ùƒ</li>
                    <li><div class="check-icon">âœ“</div>Ù…ØªØ§Ø¨Ø¹Ø© Ø­Ø§Ù„Ø© Ø·Ù„Ø¨Ùƒ Ù„Ø­Ø¸Ø© Ø¨Ù„Ø­Ø¸Ø© Ù…Ø¹ Ø¥Ø´Ø¹Ø§Ø±Ø§Øª ÙÙˆØ±ÙŠØ© Ø¹Ù†Ø¯ ÙƒÙ„ ØªØ­Ø¯ÙŠØ«</li>
                    <li><div class="check-icon">âœ“</div>ØªÙˆØ§ØµÙ„ Ù…Ø¨Ø§Ø´Ø± Ù…Ø¹ Ø§Ù„Ù…ÙƒØªØ¨ ÙˆØ¥Ù…ÙƒØ§Ù†ÙŠØ© Ø§Ø³ØªÙ„Ø§Ù… ÙˆØªØ­Ù…ÙŠÙ„ Ø§Ù„ÙˆØ«Ø§Ø¦Ù‚ Ø¥Ù„ÙƒØªØ±ÙˆÙ†ÙŠØ§Ù‹</li>
                    <li><div class="check-icon">âœ“</div>Ø³Ø¬Ù„ ÙƒØ§Ù…Ù„ Ø¨Ø¬Ù…ÙŠØ¹ Ù…Ø¹Ø§Ù…Ù„Ø§ØªÙƒ Ø§Ù„Ø³Ø§Ø¨Ù‚Ø© ÙˆØªÙ‚ÙŠÙŠÙ…Ø§Øª Ù…Ø¶Ù…ÙˆÙ†Ø© Ù„Ù„Ø¬ÙˆØ¯Ø©</li>
                </ul>
                <a href="#" class="btn" style="background:rgba(255,255,255,.15);color:var(--white);border:2px solid rgba(255,255,255,.3)">Ø§Ø¨Ø¯Ø£ ÙƒÙ…Ø³ØªØ®Ø¯Ù…</a>
            </div>
        </div>
    </div>
</section>

<!-- â•â• TESTIMONIALS â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section class="testimonials">
    <div class="container">
        <div class="testimonials-header">
            <div class="section-badge">â­ Ø¢Ø±Ø§Ø¡ Ø¹Ù…Ù„Ø§Ø¦Ù†Ø§</div>
            <h2 class="section-title">Ù…Ø§Ø°Ø§ ÙŠÙ‚ÙˆÙ„ Ø¹Ù…Ù„Ø§Ø¤Ù†Ø§</h2>
            <p class="section-sub" style="margin:0 auto">Ø¢Ø±Ø§Ø¡ Ø­Ù‚ÙŠÙ‚ÙŠØ© Ù…Ù† Ù…ÙƒØ§ØªØ¨ ÙˆÙ…Ø³ØªØ®Ø¯Ù…ÙŠÙ† ÙŠØ«Ù‚ÙˆÙ† Ø¨Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="stars">â˜…â˜…â˜…â˜…â˜…</div>
                <p class="testimonial-text">"Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ ØºÙŠÙ‘Ø± Ø·Ø±ÙŠÙ‚Ø© Ø¹Ù…Ù„Ù†Ø§ Ø¨Ø§Ù„ÙƒØ§Ù…Ù„ØŒ Ø£ØµØ¨Ø­Ù†Ø§ Ù†Ø¹Ø§Ù„Ø¬ Ø¶Ø¹Ù Ø¹Ø¯Ø¯ Ø§Ù„Ø·Ù„Ø¨Ø§Øª ÙÙŠ Ù†ÙØ³ Ø§Ù„ÙˆÙ‚Øª Ù…Ø¹ Ø£Ù‚Ù„ Ø¬Ù‡Ø¯ ÙˆØ£Ø®Ø·Ø§Ø¡."</p>
                <div class="testimonial-author">
                    <div class="author-avatar" style="background:var(--green-700)">Ø£</div>
                    <div>
                        <div class="author-name">Ø£Ø­Ù…Ø¯ Ø§Ù„Ø´Ù…Ø±ÙŠ</div>
                        <div class="author-role">Ù…Ø¯ÙŠØ± Ù…ÙƒØªØ¨ Ø§Ø³ØªÙ‚Ø¯Ø§Ù… - Ø§Ù„Ø±ÙŠØ§Ø¶</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="stars">â˜…â˜…â˜…â˜…â˜…</div>
                <p class="testimonial-text">"Ø³Ù‡Ù‘Ù„ Ø¹Ù„ÙŠÙ†Ø§ Ù…ØªØ§Ø¨Ø¹Ø© Ø·Ù„Ø¨Ø§ØªÙ†Ø§ Ø¨Ø´ÙƒÙ„ ÙƒØ¨ÙŠØ±ØŒ ÙØ±ÙŠÙ‚ Ø§Ù„Ø¯Ø¹Ù… ÙƒØ§Ù† Ù…ØªØ¬Ø§ÙˆØ¨Ø§Ù‹ Ø¬Ø¯Ø§Ù‹ ÙÙŠ Ø­Ù„ Ø£ÙŠ Ù…Ø´ÙƒÙ„Ø© ÙˆØ§Ø¬Ù‡Ù†Ø§Ù‡Ø§."</p>
                <div class="testimonial-author">
                    <div class="author-avatar" style="background:#7c3aed">Ø³</div>
                    <div>
                        <div class="author-name">Ø³Ø§Ø±Ø© Ø§Ù„Ù…Ø·ÙŠØ±ÙŠ</div>
                        <div class="author-role">Ù…Ø³Ø¤ÙˆÙ„Ø© Ø§Ù„Ù…ÙˆØ§Ø±Ø¯ Ø§Ù„Ø¨Ø´Ø±ÙŠØ© - Ø¬Ø¯Ø©</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="stars">â˜…â˜…â˜…â˜…â˜…</div>
                <p class="testimonial-text">"Ø§Ù„Ù†Ø¸Ø§Ù… Ø³Ù‡Ù‘Ù„ Ø¹Ù„Ù‰ Ø¹Ù…Ù„Ø§Ø¦Ù†Ø§ Ù…ØªØ§Ø¨Ø¹Ø© Ø·Ù„Ø¨Ø§ØªÙ‡Ù…ØŒ ÙˆØ²Ø§Ø¯ Ø±Ø¶Ø§Ù‡Ù… Ø¨Ø´ÙƒÙ„ Ù…Ù„Ø­ÙˆØ¸. Ø£Ù†ØµØ­ Ø¨Ù‡ ÙƒÙ„ Ù…ÙƒØªØ¨ ÙŠØ±ÙŠØ¯ Ø§Ù„ØªØ·ÙˆØ±."</p>
                <div class="testimonial-author">
                    <div class="author-avatar" style="background:#0369a1">Ù…</div>
                    <div>
                        <div class="author-name">Ù…Ø­Ù…Ø¯ Ø§Ù„Ø¹ØªÙŠØ¨ÙŠ</div>
                        <div class="author-role">ØµØ§Ø­Ø¨ Ù…ÙƒØªØ¨ Ø§Ø³ØªÙ‚Ø¯Ø§Ù… - Ø§Ù„Ø¯Ù…Ø§Ù…</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- â•â• CTA â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section class="cta" id="contact">
    <div class="container">
        <div class="cta-inner">
            <div class="section-badge" style="background:rgba(255,255,255,.15);color:var(--white);border:1px solid rgba(255,255,255,.25);margin:0 auto 1rem">ðŸš€ Ø§Ø¨Ø¯Ø£ Ø§Ù„ÙŠÙˆÙ…</div>
            <h2 class="cta-title">Ù†Ø¸Ø§Ù… Ù…ØªÙƒØ§Ù…Ù„.. Ù„Ø¥Ø¯Ø§Ø±Ø© Ø£ÙØ¶Ù„</h2>
            <p class="cta-sub">
                Ø§Ù†Ø¶Ù… Ø¥Ù„Ù‰ Ø£ÙƒØ«Ø± Ù…Ù† 500 Ù…ÙƒØªØ¨ Ø§Ø³ØªÙ‚Ø¯Ø§Ù… ÙŠØ³ØªØ®Ø¯Ù…ÙˆÙ† Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ ÙŠÙˆÙ…ÙŠØ§Ù‹<br>
                ÙˆØ§Ø¨Ø¯Ø£ Ø±Ø­Ù„ØªÙƒ Ù†Ø­Ùˆ Ø¹Ù…Ù„ Ø£ÙƒØ«Ø± Ø§Ø­ØªØ±Ø§ÙÙŠØ© ÙˆÙƒÙØ§Ø¡Ø©
            </p>
            <div class="cta-actions">
                <a href="#" class="btn btn-primary">ðŸš€ Ø§Ø¨Ø¯Ø£ Ù…Ø¬Ø§Ù†Ø§Ù‹ Ø§Ù„Ø¢Ù†</a>
                <a href="tel:+966000000000" class="btn btn-outline">ðŸ“ž ØªÙˆØ§ØµÙ„ Ù…Ø¹Ù†Ø§</a>
            </div>
            <p style="color:rgba(255,255,255,.5);font-size:.85rem;margin-top:1.5rem">Ù„Ø§ ÙŠÙ„Ø²Ù… Ø¨Ø·Ø§Ù‚Ø© Ø§Ø¦ØªÙ…Ø§Ù†ÙŠØ© Â· ØªØ¬Ø±Ø¨Ø© Ù…Ø¬Ø§Ù†ÙŠØ© 14 ÙŠÙˆÙ…</p>
        </div>
    </div>
</section>

<!-- â•â• FOOTER â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<footer>
    <div class="container">
        <div class="footer-inner">
            <div>
                <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.5rem">
                    <div class="logo-icon" style="width:38px;height:38px;font-size:1.1rem">Ù…</div>
                    <div class="logo-text">Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ</div>
                </div>
                <p class="footer-desc">Ù…Ù†ØµØ© Ù…ØªÙƒØ§Ù…Ù„Ø© ØªØ±Ø¨Ø· Ù…ÙƒØ§ØªØ¨ Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù… ÙˆØ§Ù„Ù…Ø³ØªØ®Ø¯Ù…ÙŠÙ† ÙÙŠ Ù…Ù†Ø¸ÙˆÙ…Ø© ÙˆØ§Ø­Ø¯Ø© Ù„ØªÙ‚Ø¯ÙŠÙ… Ø®Ø¯Ù…Ø§Øª Ø§Ù„Ø§Ø³ØªÙ‚Ø¯Ø§Ù… Ø¨Ø§Ø­ØªØ±Ø§ÙÙŠØ© ÙˆØ³Ù‡ÙˆÙ„Ø©.</p>
                <div class="footer-social">
                    <a class="social-btn" href="#" title="ØªÙˆÙŠØªØ±">ð•</a>
                    <a class="social-btn" href="#" title="Ø¥Ù†Ø³ØªØºØ±Ø§Ù…">ðŸ“¸</a>
                    <a class="social-btn" href="#" title="ÙˆØ§ØªØ³Ø§Ø¨">ðŸ’¬</a>
                    <a class="social-btn" href="#" title="ÙŠÙˆØªÙŠÙˆØ¨">â–¶</a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Ø±ÙˆØ§Ø¨Ø· Ø³Ø±ÙŠØ¹Ø©</h4>
                <ul>
                    <li><a href="#">Ø§Ù„Ø±Ø¦ÙŠØ³ÙŠØ©</a></li>
                    <li><a href="#about">Ø¹Ù† Ø§Ù„ØªØ·Ø¨ÙŠÙ‚</a></li>
                    <li><a href="#features">Ø§Ù„Ù…Ù…ÙŠØ²Ø§Øª</a></li>
                    <li><a href="#how">ÙƒÙŠÙ ÙŠØ¹Ù…Ù„</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Ø®Ø¯Ù…Ø§ØªÙ†Ø§</h4>
                <ul>
                    <li><a href="#">Ø¥Ø¯Ø§Ø±Ø© Ø§Ù„Ø·Ù„Ø¨Ø§Øª</a></li>
                    <li><a href="#">Ø¥Ø¯Ø§Ø±Ø© Ø§Ù„Ù…ÙƒØ§ØªØ¨</a></li>
                    <li><a href="#">Ø§Ù„Ø³ÙŠØ± Ø§Ù„Ø°Ø§ØªÙŠØ©</a></li>
                    <li><a href="#">Ø§Ù„ØªÙ‚Ø§Ø±ÙŠØ±</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>ØªÙˆØ§ØµÙ„ Ù…Ø¹Ù†Ø§</h4>
                <ul>
                    <li><a href="mailto:info@merry.sa">info@merry.sa</a></li>
                    <li><a href="tel:+966000000000">+966 00 000 0000</a></li>
                    <li><a href="#">Ø§Ù„Ù…Ù…Ù„ÙƒØ© Ø§Ù„Ø¹Ø±Ø¨ÙŠØ© Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©</a></li>
                    <li><a href="#">Ø³ÙŠØ§Ø³Ø© Ø§Ù„Ø®ØµÙˆØµÙŠØ©</a></li>
                </ul>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="footer-bottom">
            <p>Â© {{ date('Y') }} Ù†Ø¸Ø§Ù… Ù…ÙŠØ±ÙŠ. Ø¬Ù…ÙŠØ¹ Ø§Ù„Ø­Ù‚ÙˆÙ‚ Ù…Ø­ÙÙˆØ¸Ø©.</p>
            <p>ØµÙÙ†Ø¹ Ø¨Ù€ â¤ï¸ ÙÙŠ Ø§Ù„Ù…Ù…Ù„ÙƒØ© Ø§Ù„Ø¹Ø±Ø¨ÙŠØ© Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©</p>
        </div>
    </div>
</footer>

<script>
    window.addEventListener('scroll', () => {
        document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
    });

    function toggleMenu() {}

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.about-card, .feature-card, .testimonial-card, .audience-panel, .how-step').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity .6s ease, transform .6s ease';
        observer.observe(el);
    });

    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-links a');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(s => { if (window.scrollY >= s.offsetTop - 100) current = s.id; });
        navLinks.forEach(a => {
            a.classList.remove('active');
            if (a.getAttribute('href') === '#' + current) a.classList.add('active');
        });
    });
</script>
</body>
</html>
