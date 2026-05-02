<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نظام ميري - منصة متكاملة لإدارة خدمات الاستقدام</title>
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

        /* Navbar */
        nav {
            position: fixed; top: 0; width: 100%; z-index: 1000;
            background: rgba(5,79,49,.97); backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,.1);
            transition: all .3s ease;
        }
        nav.scrolled { box-shadow: 0 4px 30px rgba(5,79,49,.4); }
        .nav-inner { display: flex; align-items: center; justify-content: space-between; height: 70px; }
        .nav-logo { display: flex; align-items: center; gap: .75rem; text-decoration: none; }
        .logo-icon {
            width: 42px; height: 42px; background: var(--white);
            border-radius: 10px; display: flex; align-items: center;
            justify-content: center; font-size: 1.3rem; font-weight: 900;
            color: var(--green-800); flex-shrink: 0;
        }
        .logo-img { height: 44px; width: auto; display: block; filter: brightness(0) invert(1); }
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

        /* Hero */
        .hero {
            min-height: 100vh; padding: 100px 0 60px;
            background: linear-gradient(135deg, var(--green-900) 0%, var(--green-800) 40%, var(--green-700) 100%);
            position: relative; overflow: hidden; display: flex; align-items: center;
        }
        .hero::before {
            content: ''; position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .hero-blob { position: absolute; border-radius: 50%; filter: blur(80px); opacity: .15; }
        .hero-blob-1 { width: 600px; height: 600px; background: var(--green-400); top: -200px; left: -200px; }
        .hero-blob-2 { width: 400px; height: 400px; background: var(--gold); bottom: -100px; right: -100px; }
        .hero-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; position: relative; z-index: 1; }
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
        .chart-label { font-size: .65rem; color: var(--text-light); width: 50px; text-align: right; }
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

        /* About */
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

        /* Features */
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

        /* How */
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

        /* Audience */
        .audience { padding: 100px 0; background: var(--green-900); position: relative; overflow: hidden; }
        .audience::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
        .audience-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; position: relative; z-index: 1; }
        .audience-panel { background: rgba(255,255,255,.06); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,.1); border-radius: var(--radius-xl); padding: 2.5rem; }
        .audience-panel-title { display: flex; align-items: center; gap: 1rem; font-size: 1.4rem; font-weight: 800; color: var(--white); margin-bottom: .75rem; padding-bottom: 1.25rem; border-bottom: 1px solid rgba(255,255,255,.1); }
        .audience-panel-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .audience-list { list-style: none; display: flex; flex-direction: column; gap: .9rem; margin-bottom: 2rem; }
        .audience-list li { display: flex; align-items: flex-start; gap: .75rem; color: rgba(255,255,255,.8); font-size: .95rem; line-height: 1.6; }
        .check-icon { width: 20px; height: 20px; border-radius: 50%; background: var(--green-600); display: flex; align-items: center; justify-content: center; font-size: .65rem; color: var(--white); flex-shrink: 0; margin-top: .15rem; }

        /* Testimonials */
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

        /* CTA */
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

        /* Footer */
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

        /* Animations */
        @keyframes pulse { 0%,100%{transform:scale(1);opacity:1} 50%{transform:scale(1.4);opacity:.7} }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }
        @keyframes fadeInUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }
        .fade-in-up { animation: fadeInUp .7s ease forwards; }
        .delay-1 { animation-delay: .15s; opacity: 0; }
        .delay-2 { animation-delay: .3s;  opacity: 0; }
        .delay-3 { animation-delay: .45s; opacity: 0; }
        .delay-4 { animation-delay: .6s;  opacity: 0; }

        /* Hero image */
        .hero-mockup-img {
            width: 100%; display: block; border-radius: 16px;
            box-shadow: 0 40px 100px rgba(0,0,0,.35);
        }

        /* About section — image + text layout */
        .about-top { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; margin-bottom: 4rem; }
        .about-img-wrap {
            border-radius: var(--radius-xl);
            overflow: hidden;
            aspect-ratio: 1 / 1;
            background: var(--green-50);
            filter: drop-shadow(0 20px 40px rgba(5,79,49,.15));
        }
        .about-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: right center;
            display: block;
        }
        .about-cards-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 1.25rem; }

        /* Multi-device section */
        .devices { padding: 100px 0; background: var(--white); }
        .devices-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
        .devices-img { width: 100%; display: block; border-radius: var(--radius-xl); background: var(--green-50); filter: drop-shadow(0 20px 50px rgba(5,79,49,.2)); }

        /* Responsive */
        @media (max-width: 1024px) {
            .features-grid { grid-template-columns: repeat(2,1fr); }
            .testimonials-grid { grid-template-columns: repeat(2,1fr); }
            .footer-inner { grid-template-columns: 1fr 1fr; }
            .about-cards-row { grid-template-columns: repeat(2,1fr); }
        }
        @media (max-width: 768px) {
            .nav-links, .nav-cta { display: none; }
            .hamburger { display: flex; }
            .hero-inner { grid-template-columns: 1fr; text-align: center; }
            .hero-visual { display: none; }
            .hero-actions { justify-content: center; }
            .hero-stats { justify-content: center; }
            .about-inner { grid-template-columns: 1fr; }
            .about-top { grid-template-columns: 1fr; }
            .about-cards-row { grid-template-columns: 1fr 1fr; }
            .devices-inner { grid-template-columns: 1fr; }
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

<!-- NAVBAR -->
<nav id="navbar">
    <div class="container">
        <div class="nav-inner">
            <a href="#" class="nav-logo">
                <img src="/images/merry-logo.png" alt="نظام ميري" class="logo-img">
            </a>

            <ul class="nav-links">
                <li><a href="#" class="active">الرئيسية</a></li>
                <li><a href="#about">عن التطبيق</a></li>
                <li><a href="#features">المميزات</a></li>
                <li><a href="#how">كيف يعمل</a></li>
                <li><a href="#audience">للمكاتب</a></li>
                <li><a href="#contact">تواصل معنا</a></li>
            </ul>

            <div class="nav-cta">
                <a href="/office/login" class="nav-btn nav-btn-outline">دخول المكتب</a>
                <a href="/admin/login" class="nav-btn nav-btn-solid">لوحة التحكم</a>
            </div>

            <div class="hamburger" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero" id="home">
    <div class="hero-blob hero-blob-1"></div>
    <div class="hero-blob hero-blob-2"></div>

    <div class="container">
        <div class="hero-inner">
            <div>
                <div class="hero-badge fade-in-up">
                    <span></span>
                    منصة موثوقة لأكثر من 500 مكتب
                </div>

                <h1 class="hero-title fade-in-up delay-1">
                    منصة متكاملة<br>
                    لإدارة <span class="highlight">خدمات الاستقدام</span>
                </h1>

                <p class="hero-desc fade-in-up delay-2">
                    نظام ميري يساعد مكاتب الاستقدام والمستخدمين في منظومة واحدة تضم جميع خدمات
                    ومتابعة الحالات وتنظيم البيانات والاطلاع على التقارير بسهولة وكفاءة عالية.
                </p>

                <div class="hero-actions fade-in-up delay-3">
                    <a href="#" class="btn btn-primary">🚀 ابدأ مجاناً</a>
                    <a href="#about" class="btn btn-outline">تعرف على المزيد</a>
                </div>

                <div class="hero-stats fade-in-up delay-4">
                    <div class="stat-item">
                        <span class="stat-num">+500</span>
                        <span class="stat-label">مكتب استقدام</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">+10K</span>
                        <span class="stat-label">سيرة ذاتية</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">99%</span>
                        <span class="stat-label">رضا العملاء</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">24/7</span>
                        <span class="stat-label">دعم فني</span>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="floating-badge badge-a">
                    <div class="badge-icon" style="background:#dcfce7">✅</div>
                    <div>
                        <div style="color:#054F31;font-size:.85rem">طلب جديد</div>
                        <div style="color:#6b7280;font-size:.7rem">تمت الموافقة</div>
                    </div>
                </div>

                <img src="/images/dashboard-mockup.png"
                     alt="نظام ميري - لوحة التحكم"
                     class="hero-mockup-img">

                <div class="floating-badge badge-b">
                    <div class="badge-icon" style="background:#fef3c7">⭐</div>
                    <div>
                        <div style="color:#054F31;font-size:.85rem">تقييم ممتاز</div>
                        <div style="color:#6b7280;font-size:.7rem">4.9 / 5.0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="about" id="about">
    <div class="container">
        <div class="about-top">
            <div class="about-img-wrap">
                <img src="/images/hero-users.png" alt="مستخدمو نظام ميري">
            </div>
            <div>
                <div class="section-badge">✨ عن التطبيق</div>
                <h2 class="section-title">نظام شامل لكل ما تحتاجه</h2>
                <p class="section-sub">
                    نظام ميري هو منصة تقنية متطورة تربط مكاتب الاستقدام والمستخدمين في منظومة واحدة
                    لتقديم خدمات الاستقدام من تقديم الطلب حتى إتمام الخدمة بكل سهولة واحترافية.
                </p>
                <div style="margin-top:2rem;display:flex;flex-direction:column;gap:.75rem">
                    <div style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">✓</div>
                        واجهة سهلة الاستخدام باللغة العربية الكاملة
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">✓</div>
                        تقارير ولوحات إحصائية فورية ومتكاملة
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">✓</div>
                        دعم كامل للأجهزة المحمولة والحاسوب
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">✓</div>
                        حماية عالية للبيانات وخصوصية تامة
                    </div>
                </div>
            </div>
        </div>
        <div class="about-cards-row">
            <div class="about-card">
                <div class="card-icon-wrap" style="background:#dcfce7">📋</div>
                <div class="card-title">إدارة الطلبات</div>
                <div class="card-desc">متابعة كل طلبات الاستقدام من البداية إلى الإتمام النهائي</div>
            </div>
            <div class="about-card">
                <div class="card-icon-wrap" style="background:#dbeafe">🗄️</div>
                <div class="card-title">إدارة البيانات</div>
                <div class="card-desc">قاعدة بيانات موحدة لكل المعاملات والوثائق والسجلات</div>
            </div>
            <div class="about-card">
                <div class="card-icon-wrap" style="background:#fef3c7">🔔</div>
                <div class="card-title">متابعة الحالات</div>
                <div class="card-desc">إشعارات فورية وتتبع لحظي لكل مرحلة من مراحل الطلب</div>
            </div>
            <div class="about-card">
                <div class="card-icon-wrap" style="background:#fce7f3">📊</div>
                <div class="card-title">التقارير والإشعارات</div>
                <div class="card-desc">تقارير تفصيلية وإشعارات ذكية تبقيك على اطلاع دائم</div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="features" id="features">
    <div class="container">
        <div class="features-header">
            <div class="section-badge">⚡ مميزات نظام ميري</div>
            <h2 class="section-title">كل ما تحتاجه في مكان واحد</h2>
            <p class="section-sub">نوفر لك أدوات متطورة تجعل إدارة أعمال الاستقدام أسرع وأكثر دقة وكفاءة</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon" style="background:#dcfce7">👥</div>
                <div class="feature-title">إدارة المستخدمين والصلاحيات</div>
                <div class="feature-desc">تحكم كامل في الأدوار والصلاحيات لكل فرد في فريقك بمرونة عالية</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#dbeafe">📊</div>
                <div class="feature-title">لوحة تحكم متكاملة</div>
                <div class="feature-desc">إحصاءات ومؤشرات أداء فورية تساعدك على اتخاذ قرارات صحيحة</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#fef3c7">⚡</div>
                <div class="feature-title">إدارة سير العمل</div>
                <div class="feature-desc">أتمتة ذكية لعمليات الاستقدام تقلل الأخطاء وتوفر الوقت والجهد</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#fce7f3">🔔</div>
                <div class="feature-title">إشعارات وتنبيهات ذكية</div>
                <div class="feature-desc">ابق على اطلاع دائم بكل المستجدات والتحديثات في الوقت الفعلي</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#f0fdf4">📈</div>
                <div class="feature-title">تقارير وإحصائيات مفصلة</div>
                <div class="feature-desc">تحليلات متعمقة وتقارير شاملة لكل جوانب عملك وأدائك</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#ede9fe">🛡️</div>
                <div class="feature-title">دعم فني متوفر</div>
                <div class="feature-desc">فريق دعم متخصص على مدار الساعة لمساعدتك في أي وقت تحتاجه</div>
            </div>
        </div>
    </div>
</section>

<!-- MULTI-DEVICE -->
<section class="devices">
    <div class="container">
        <div class="devices-inner">
            <div>
                <div class="section-badge">📱 متعدد المنصات</div>
                <h2 class="section-title">يعمل على جميع أجهزتك</h2>
                <p class="section-sub">
                    سواء كنت على الحاسوب أو الجوال أو الجهاز اللوحي، نظام ميري يوفر لك
                    تجربة سلسة ومتكاملة في أي وقت ومن أي مكان.
                </p>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:.8rem;margin-top:1.5rem">
                    <li style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">✓</div>
                        متوافق مع جميع أنواع الأجهزة والمتصفحات
                    </li>
                    <li style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">✓</div>
                        تصميم متجاوب يتكيف مع حجم شاشتك تلقائياً
                    </li>
                    <li style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">✓</div>
                        مزامنة فورية بين جميع أجهزتك في الوقت الحقيقي
                    </li>
                    <li style="display:flex;align-items:center;gap:.75rem;color:var(--text-mid);font-size:.95rem">
                        <div style="width:24px;height:24px;background:var(--green-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--green-700);font-size:.7rem;flex-shrink:0">✓</div>
                        وصول سريع وآمن من أي مكان في العالم
                    </li>
                </ul>
            </div>
            <div>
                <img src="/images/multi-device.png" alt="نظام ميري على جميع الأجهزة" class="devices-img">
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="how" id="how">
    <div class="container">
        <div class="how-header">
            <div class="section-badge">🔄 كيف يعمل النظام؟</div>
            <h2 class="section-title">خطوات بسيطة للبداية</h2>
            <p class="section-sub" style="margin:0 auto">خمس خطوات سهلة تبدأ بها رحلتك مع نظام ميري</p>
        </div>
        <div class="how-steps">
            <div class="how-step">
                <div class="step-num">01</div>
                <div class="step-title">تقديم الطلب</div>
                <div class="step-desc">يقدم المستخدم طلبه بكل سهولة عبر المنصة</div>
            </div>
            <div class="how-step">
                <div class="step-num">02</div>
                <div class="step-title">دراسة الطلب</div>
                <div class="step-desc">يراجع المكتب الطلب ويقيّم الاحتياجات</div>
            </div>
            <div class="how-step">
                <div class="step-num">03</div>
                <div class="step-title">متابعة الحالة</div>
                <div class="step-desc">تتبع لحظي لكل مرحلة من مراحل المعالجة</div>
            </div>
            <div class="how-step">
                <div class="step-num">04</div>
                <div class="step-title">إتمام الخدمة</div>
                <div class="step-desc">إتمام جميع الإجراءات واستكمال المعاملات</div>
            </div>
            <div class="how-step">
                <div class="step-num">05</div>
                <div class="step-title">التقارير والتوصيات</div>
                <div class="step-desc">استلام التقرير النهائي وتقييم الخدمة المقدمة</div>
            </div>
        </div>
    </div>
</section>

<!-- AUDIENCE -->
<section class="audience" id="audience">
    <div class="container">
        <div style="text-align:center;margin-bottom:4rem;position:relative;z-index:1">
            <div class="section-badge" style="background:rgba(255,255,255,.12);color:var(--white);border:1px solid rgba(255,255,255,.2)">👥 من يستخدم النظام</div>
            <h2 class="section-title" style="color:var(--white)">حل شامل للجميع</h2>
        </div>
        <div class="audience-inner">
            <div class="audience-panel">
                <div class="audience-panel-title">
                    <div class="audience-panel-icon" style="background:rgba(34,197,94,.2)">🏢</div>
                    للمكاتب
                </div>
                <ul class="audience-list">
                    <li><div class="check-icon">✓</div>لوحة تحكم متكاملة لإدارة جميع طلبات الاستقدام ومتابعتها لحظة بلحظة</li>
                    <li><div class="check-icon">✓</div>أدوات متطورة لرفع السير الذاتية وإدارة قاعدة بيانات العمالة</li>
                    <li><div class="check-icon">✓</div>تقارير مالية وإحصائية شاملة لمتابعة أداء المكتب ونموه</li>
                    <li><div class="check-icon">✓</div>إشعارات فورية للطلبات الجديدة وتحديثات حالة كل معاملة</li>
                    <li><div class="check-icon">✓</div>إدارة العروض الترويجية والكوبونات وخطط الاشتراكات بمرونة</li>
                </ul>
                <a href="#" class="btn" style="background:var(--green-500);color:var(--white)">ابدأ مع مكتبك</a>
            </div>
            <div class="audience-panel">
                <div class="audience-panel-title">
                    <div class="audience-panel-icon" style="background:rgba(59,130,246,.2)">👤</div>
                    للمستخدمين
                </div>
                <ul class="audience-list">
                    <li><div class="check-icon">✓</div>تقديم طلبات الاستقدام بشكل سهل وسريع من أي مكان وأي وقت</li>
                    <li><div class="check-icon">✓</div>تصفح السير الذاتية واختيار أفضل المرشحين المناسبين لاحتياجك</li>
                    <li><div class="check-icon">✓</div>متابعة حالة طلبك لحظة بلحظة مع إشعارات فورية عند كل تحديث</li>
                    <li><div class="check-icon">✓</div>تواصل مباشر مع المكتب وإمكانية استلام وتحميل الوثائق إلكترونياً</li>
                    <li><div class="check-icon">✓</div>سجل كامل بجميع معاملاتك السابقة وتقييمات مضمونة للجودة</li>
                </ul>
                <a href="#" class="btn" style="background:rgba(255,255,255,.15);color:var(--white);border:2px solid rgba(255,255,255,.3)">ابدأ كمستخدم</a>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials">
    <div class="container">
        <div class="testimonials-header">
            <div class="section-badge">⭐ آراء عملائنا</div>
            <h2 class="section-title">ماذا يقول عملاؤنا</h2>
            <p class="section-sub" style="margin:0 auto">آراء حقيقية من مكاتب ومستخدمين يثقون بنظام ميري</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="stars">★★★★★</div>
                <p class="testimonial-text">"نظام ميري غيّر طريقة عملنا بالكامل، أصبحنا نعالج ضعف عدد الطلبات في نفس الوقت مع أقل جهد وأخطاء."</p>
                <div class="testimonial-author">
                    <div class="author-avatar" style="background:var(--green-700)">أ</div>
                    <div>
                        <div class="author-name">أحمد الشمري</div>
                        <div class="author-role">مدير مكتب استقدام - الرياض</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="stars">★★★★★</div>
                <p class="testimonial-text">"سهّل علينا متابعة طلباتنا بشكل كبير، فريق الدعم كان متجاوباً جداً في حل أي مشكلة واجهناها."</p>
                <div class="testimonial-author">
                    <div class="author-avatar" style="background:#7c3aed">س</div>
                    <div>
                        <div class="author-name">سارة المطيري</div>
                        <div class="author-role">مسؤولة الموارد البشرية - جدة</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="stars">★★★★★</div>
                <p class="testimonial-text">"النظام سهّل على عملائنا متابعة طلباتهم، وزاد رضاهم بشكل ملحوظ. أنصح به كل مكتب يريد التطور."</p>
                <div class="testimonial-author">
                    <div class="author-avatar" style="background:#0369a1">م</div>
                    <div>
                        <div class="author-name">محمد العتيبي</div>
                        <div class="author-role">صاحب مكتب استقدام - الدمام</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta" id="contact">
    <div class="container">
        <div class="cta-inner">
            <div class="section-badge" style="background:rgba(255,255,255,.15);color:var(--white);border:1px solid rgba(255,255,255,.25);margin:0 auto 1rem">🚀 ابدأ اليوم</div>
            <h2 class="cta-title">نظام متكامل.. لإدارة أفضل</h2>
            <p class="cta-sub">
                انضم إلى أكثر من 500 مكتب استقدام يستخدمون نظام ميري يومياً<br>
                وابدأ رحلتك نحو عمل أكثر احترافية وكفاءة
            </p>
            <div class="cta-actions">
                <a href="#" class="btn btn-primary">🚀 ابدأ مجاناً الآن</a>
                <a href="tel:+966000000000" class="btn btn-outline">📞 تواصل معنا</a>
            </div>
            <p style="color:rgba(255,255,255,.5);font-size:.85rem;margin-top:1.5rem">لا يلزم بطاقة ائتمانية · تجربة مجانية 14 يوم</p>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="footer-inner">
            <div>
                <div style="margin-bottom:.5rem">
                    <img src="/images/merry-logo.png" alt="نظام ميري" style="height:44px;width:auto;filter:brightness(0) invert(1)">
                </div>
                <p class="footer-desc">منصة متكاملة تربط مكاتب الاستقدام والمستخدمين في منظومة واحدة لتقديم خدمات الاستقدام باحترافية وسهولة.</p>
                <div class="footer-social">
                    <a class="social-btn" href="#" title="تويتر">𝕏</a>
                    <a class="social-btn" href="#" title="إنستغرام">📸</a>
                    <a class="social-btn" href="#" title="واتساب">💬</a>
                    <a class="social-btn" href="#" title="يوتيوب">▶</a>
                </div>
            </div>
            <div class="footer-col">
                <h4>روابط سريعة</h4>
                <ul>
                    <li><a href="#">الرئيسية</a></li>
                    <li><a href="#about">عن التطبيق</a></li>
                    <li><a href="#features">المميزات</a></li>
                    <li><a href="#how">كيف يعمل</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>خدماتنا</h4>
                <ul>
                    <li><a href="#">إدارة الطلبات</a></li>
                    <li><a href="#">إدارة المكاتب</a></li>
                    <li><a href="#">السير الذاتية</a></li>
                    <li><a href="#">التقارير</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>تواصل معنا</h4>
                <ul>
                    <li><a href="mailto:info@merry.sa">info@merry.sa</a></li>
                    <li><a href="tel:+966000000000">+966 00 000 0000</a></li>
                    <li><a href="#">المملكة العربية السعودية</a></li>
                    <li><a href="#">سياسة الخصوصية</a></li>
                </ul>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="footer-bottom">
            <p>© {{ date('Y') }} نظام ميري. جميع الحقوق محفوظة.</p>
            <p>صُنع بـ ❤️ في المملكة العربية السعودية</p>
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
