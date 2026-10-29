<?php
require_once __DIR__ . '/config/db.php';
$initialUser = getCurrentUser();
$initialOwner = isOwner();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manjusha K Madhavan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500&family=Jost:wght@300;400;500&family=Cinzel:wght@500;700&family=Playfair+Display:wght@500;600&family=Marcellus&family=Bodoni+Moda:ital,wght@0,500;1,500&family=Great+Vibes&display=swap" rel="stylesheet">
<style>
:root{--ink:#000;--gold:#d8b878;--moon:#bcd0ff;--text:#ece9e2;--muted:#9a9aa8;--glass:rgba(8,10,28,.62)}
html,body{background:#000;color:var(--text);font-family:'Jost',sans-serif;font-weight:300}
h1,h2,h3,h4,.serif{font-family:'Cormorant Garamond',serif;font-weight:500}
.page{display:none;min-height:100vh}.page.active{display:block}

/* ---------- Landing ---------- */
#landing{position:relative;background:radial-gradient(ellipse at 20% 10%,#14141f 0,#000 60%);overflow:hidden}
#landing::before{content:"";position:absolute;inset:0;background-image:radial-gradient(1px 1px at 20% 30%,#fff8 50%,transparent),radial-gradient(1px 1px at 70% 20%,#fff6 50%,transparent),radial-gradient(1px 1px at 85% 70%,#fff5 50%,transparent),radial-gradient(1px 1px at 40% 80%,#fff5 50%,transparent),radial-gradient(1px 1px at 10% 65%,#fff4 50%,transparent);}
.topbar{position:relative;z-index:2;padding:1.4rem 0}
.brand{font-family:'Cormorant Garamond',serif;font-size:1.5rem;letter-spacing:.04em}
.btn-gold{border:1px solid var(--gold);color:var(--gold);background:transparent;border-radius:0;padding:.45rem 1.4rem}
.btn-gold:hover,.btn-gold:focus{background:var(--gold);color:#000}
.btn-solid{background:var(--gold);color:#000;border-radius:0;border:0;padding:.6rem 1.8rem;font-weight:500}
.btn-solid:hover{background:#fff;color:#000}
.hero{position:relative;z-index:1;min-height:78vh;display:flex;align-items:center}
.hero h1{font-size:clamp(3.2rem,9vw,7.5rem);line-height:.95;letter-spacing:-.01em}
.hero p{max-width:34rem;color:var(--muted);font-size:1.15rem;margin-top:1.5rem}
.moon-orb{position:absolute;right:-8vw;top:12vh;width:min(46vw,520px);aspect-ratio:1;border-radius:50%;background:url(images/moon.webp) 8% 18%/420% no-repeat, radial-gradient(circle, #bcd0ff 20%, #1a2238 80%);opacity:.9;box-shadow:0 0 90px 10px #5d7bd855}

/* ---------- Login ---------- */
#login{background:linear-gradient(#000a,#000d),url(images/moon.webp) center/cover;display:none;align-items:center;justify-content:center}
#login.active{display:flex}
.login-box{width:min(420px,92vw);background:var(--glass);border:1px solid #ffffff22;padding:2.2rem;backdrop-filter:blur(8px)}
.form-control{background:#0006;border:1px solid #ffffff33;color:#fff;border-radius:0}
.form-control:focus{background:#000a;color:#fff;border-color:var(--gold);box-shadow:none}
.nav-tabs-lite button{background:none;border:0;color:var(--muted);padding:.3rem 0;margin-right:1.4rem;border-bottom:2px solid transparent}
.nav-tabs-lite button.on{color:#fff;border-color:var(--gold)}

/* ---------- Home ---------- */
#home{background:#02030a}
.home-head{background:linear-gradient(#000c,#02030a),url(images/moon.webp) center 30%/cover;padding-bottom:2rem}
.avatar{width:150px;height:150px;border-radius:50%;object-fit:cover;object-position:center 30%;border:2px solid var(--gold);box-shadow:0 0 0 6px #ffffff10}
.fly{width:100%;max-width:340px;aspect-ratio:4/3;object-fit:cover;border:1px solid #ffffff22}
.big-card{position:relative;min-height:230px;border:1px solid #ffffff2a;padding:2rem;cursor:pointer;color:#fff;display:flex;flex-direction:column;justify-content:flex-end;background:linear-gradient(#0000,#000b),var(--bg) center/cover;transition:border-color .25s,transform .25s;text-align:left;width:100%}
.big-card:hover,.big-card:focus-visible,.big-card.on{border-color:var(--gold);transform:translateY(-3px);outline:0}
.big-card h2{font-size:2.4rem;margin:0}.big-card span{color:#cfd3e6}
.sub-card{min-height:150px;background:linear-gradient(#0008,#000d),url(images/moon.webp) var(--pos,50% 50%)/cover;border:1px solid #ffffff22;color:#fff;padding:1.2rem;text-align:left;width:100%;cursor:pointer;transition:border-color .25s}
.sub-card:hover,.sub-card.on{border-color:var(--gold)}
.sub-card h3{margin:0;font-size:1.7rem}.sub-card small{color:#b9bfd8}
.group{display:none}.group.show{display:block}
.panel{display:none;background:var(--glass);border:1px solid #ffffff1f;padding:1.8rem;margin-top:1.5rem}.panel.show{display:block}
.tl{border-left:1px solid var(--gold);padding-left:1.2rem;margin-left:.3rem}
.tl .item{margin-bottom:1.3rem;position:relative}
.tl .item::before{content:"";position:absolute;left:-1.55rem;top:.55rem;width:9px;height:9px;border-radius:50%;background:var(--gold)}
.tl .when{color:var(--gold);font-size:.9rem}
.lock{border:1px dashed #ffffff40;padding:1rem;color:var(--muted);background:rgba(255,255,255,0.02)}
.quote{border-left:3px solid var(--moon);padding:.4rem 1rem;margin-bottom:1rem;font-family:'Cormorant Garamond',serif;font-size:1.3rem}
.quote small{display:block;font-family:'Jost';font-size:.8rem;color:var(--muted)}
.gal{display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:.6rem}
.gal img,.gal video,.gal .ph{width:100%;aspect-ratio:1;object-fit:cover;border:1px solid #ffffff22;background:#050713;display:block}
.ph{display:flex;align-items:center;justify-content:center;background:#0b0d22;color:var(--muted);font-size:.8rem;text-align:center;padding:.5rem;cursor:pointer}
.ph:hover{border-color:var(--gold);color:var(--gold)}
.toast-lite{position:fixed;bottom:1.2rem;left:50%;transform:translateX(-50%);background:var(--gold);color:#000;padding:.6rem 1.2rem;display:none;z-index:99;box-shadow:0 6px 20px rgba(0,0,0,0.6);font-weight:500}
.badge-pub{background:#2d6a4f}.badge-priv{background:#6a2d3a}
a{color:var(--gold)}
@media(prefers-reduced-motion:reduce){*{transition:none!important}}

.hey{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:1.9rem;color:var(--gold);margin:0 0 .4rem}
.auth-box{background:var(--glass);border:1px solid #ffffff22;padding:1.4rem;backdrop-filter:blur(8px)}
.owner-only{display:none}body.owner .owner-only{display:block}body.owner .gal.owner-only{display:grid}body.owner .visitor-only{display:none}
.group.show .col-md-4{animation:pop .6s cubic-bezier(.2,.8,.2,1) both}
.group.show .col-md-4:nth-child(2){animation-delay:.2s}.group.show .col-md-4:nth-child(3){animation-delay:.4s}
@keyframes pop{from{opacity:0;transform:translateY(26px) scale(.95)}to{opacity:1;transform:none}}
.mem{border:1px solid #ffffff22;padding:1rem;margin-bottom:1rem}.mem h5{font-family:'Cormorant Garamond',serif;font-size:1.4rem;margin:0}
.chat{background:#0007;border:1px solid #ffffff1f;padding:.7rem;margin-top:.7rem}
.msg{margin-bottom:.4rem;font-size:.95rem}
.msg b{color:var(--gold);font-weight:500}
.msg small{color:var(--muted);font-size:.75rem;margin-left:.4rem}

.hero h1{font-size:clamp(2rem,5vw,3.6rem);line-height:1.05}
.hey{font-size:1.25rem}
.sub-card{min-height:170px;background:linear-gradient(150deg,var(--c1),rgba(0,0,0,.8) 85%),url(images/moon.webp) var(--pos,50% 50%)/cover;border:1px solid var(--c2);transition:transform .3s,box-shadow .3s,border-color .3s}
.sub-card:hover,.sub-card.on{transform:translateY(-6px);box-shadow:0 12px 32px -8px var(--c2);border-color:var(--c2)}
.sub-card h3{text-shadow:0 2px 10px #000a}
.c-blue{--c1:rgba(37,99,235,.6);--c2:#6ea0ff}.c-teal{--c1:rgba(13,148,136,.6);--c2:#5eead4}.c-violet{--c1:rgba(124,58,237,.6);--c2:#c4a1ff}
.c-rose{--c1:rgba(219,39,119,.55);--c2:#ff9ccb}.c-gold{--c1:rgba(202,138,4,.58);--c2:#ffd978}.c-indigo{--c1:rgba(67,56,202,.62);--c2:#9aa3ff}
.group.show .col-md-4{animation:slideIn .8s cubic-bezier(.16,1,.3,1) both}
.group.show .col-md-4:nth-child(2){animation-delay:.3s}.group.show .col-md-4:nth-child(3){animation-delay:.6s}
@keyframes slideIn{from{opacity:0;transform:translateX(-70px) scale(.9)}to{opacity:1;transform:none}}

#landing h1{font-family:'Cinzel',serif;font-weight:700;font-size:clamp(2.2rem,5.6vw,4.2rem);letter-spacing:.07em;line-height:1.12;background:linear-gradient(180deg,#fff 10%,#e9d2a0 55%,#b8924d);-webkit-background-clip:text;background-clip:text;color:transparent;text-shadow:none;filter:drop-shadow(0 0 18px #d8b87833)}
#landing .hey{font-family:'Great Vibes',cursive;font-style:normal;font-size:clamp(2.2rem,4.5vw,3.2rem);color:#cfe0ff;margin-bottom:.2rem;text-shadow:0 0 22px #6f8fe066}
.fcard{position:relative;background:var(--glass);border:1px solid #ffffff22;padding:1.3rem;overflow:hidden;height:100%;transition:transform .3s,border-color .3s}
.fcard:hover{transform:translateY(-4px);border-color:var(--a,var(--gold))}
.fcard::before{content:attr(data-k);position:absolute;right:.8rem;top:-.4rem;font-family:'Cinzel',serif;font-size:3.8rem;line-height:1;color:var(--a,var(--gold));opacity:.13;pointer-events:none}
.fcard::after{content:"";position:absolute;left:0;top:0;bottom:0;width:3px;background:var(--a,var(--gold))}
.fcard.now{background:linear-gradient(135deg,rgba(216,184,120,.16),var(--glass))}
.fcard h4{font-size:1.55rem;margin:.3rem 0}
.pill{display:inline-block;font-size:.75rem;border:1px solid var(--a,var(--gold));color:var(--a,var(--gold));padding:.1rem .65rem;border-radius:999px}
.tag{display:inline-block;font-size:.75rem;background:#ffffff14;padding:.1rem .6rem;border-radius:999px;margin-right:.3rem}
.pbanner{margin:-1.3rem -1.3rem 1rem;padding:2.2rem 1.3rem .6rem;background:linear-gradient(135deg,var(--a),#000 120%);font-family:'Cinzel',serif;font-size:1.25rem}

#landing h1{font-family:'Playfair Display',serif;font-weight:600;letter-spacing:.01em;line-height:1.2;font-size:clamp(2.4rem,5.4vw,4rem);margin:.4rem 0 0}
#landing .hero p.hey{margin:0;line-height:1.3}
#landing .hero p:not(.hey){max-width:30rem;font-size:1.05rem;line-height:1.95;margin-top:2rem}
#landing .hero .btn-solid{margin-top:2.6rem!important}

#landing h1{font-family:'Marcellus',serif;font-weight:400;letter-spacing:.02em;background:linear-gradient(180deg,#fff 15%,#bcd0ff 70%,#8fa8f0);-webkit-background-clip:text;background-clip:text;color:transparent;filter:drop-shadow(0 0 18px #6f8fe055)}
#landing .hey{font-size:clamp(1.6rem,3vw,2.2rem)}
#landing .hero p:not(.hey){max-width:42rem;font-size:1rem}

#landing h1{font-family:'Bodoni Moda',serif;font-weight:500;letter-spacing:0;font-size:clamp(2.3rem,5.2vw,3.9rem)}
#landing .hero p:not(.hey){text-wrap:balance}

#landing .hero p:not(.hey){text-wrap:wrap;max-width:36rem}

#landing .hero p:not(.hey){max-width:54rem;font-size:1rem;text-wrap:balance}

.login-box .form-control{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.55);color:#fff;font-weight:400}
.login-box .form-control::placeholder{color:#d5d9ea;opacity:1;font-weight:400}
.login-box .form-control:focus{background:rgba(255,255,255,.16);color:#fff}

.dtabs{display:flex;gap:.4rem;background:#ffffff12;padding:.3rem;border-radius:999px}
.dtabs button{border:0;background:none;color:#cfd3e6;padding:.35rem 1rem;border-radius:999px;transition:background .25s,color .25s}
.dtabs button.on{background:var(--gold);color:#000}
.dpane{display:none;margin-top:1.4rem}.dpane.on{display:block;animation:fadeIn .5s both}
@keyframes fadeIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:none}}
.notegrid{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:1.1rem}
.sticky{background:#f4e3b8;color:#2b2418;padding:1.1rem 1.1rem .8rem;font-family:'Cormorant Garamond',serif;font-style:italic;font-size:1.4rem;line-height:1.25;box-shadow:0 10px 22px -8px #000c;transform:rotate(-1.2deg);transition:transform .3s;word-break:break-word}
.sticky:nth-child(4n+2){background:#cfe3ff;transform:rotate(1deg)}.sticky:nth-child(4n+3){background:#f6cfe0;transform:rotate(-.6deg)}.sticky:nth-child(4n+4){background:#d3efdc;transform:rotate(1.4deg)}
.sticky:hover{transform:rotate(0) scale(1.03)}
.sticky small{display:block;margin-top:.7rem;font-family:'Jost',sans-serif;font-style:normal;font-size:.75rem;color:#5b5240}.sticky a{color:#7a3b1d}
.bubble{background:rgba(188,208,255,.12);border:1px solid #bcd0ff33;border-radius:20px 20px 20px 4px;padding:.8rem 1.1rem;margin-bottom:.9rem;max-width:34rem;font-size:1.05rem}
.bubble small{display:block;color:#9aa3c7;margin-top:.3rem}
.mem{display:flex;gap:1rem;border:1px solid #d8b87855;background:linear-gradient(135deg,rgba(216,184,120,.12),rgba(8,10,28,.6));box-shadow:0 0 24px -10px #d8b878}
.dday{flex:0 0 74px;text-align:center;border-right:1px solid #d8b87855;padding-right:1rem}.dday b{display:block;font-family:'Bodoni Moda',serif;font-size:2.4rem;line-height:1;color:var(--gold);font-weight:500}.dday span{font-size:.75rem;color:var(--muted)}
.dbody{flex:1}

.panel .form-control{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.5);color:#fff;font-weight:400}
.panel .form-control::placeholder{color:#d5d9ea;opacity:1}
.panel .form-control:focus{background:rgba(255,255,255,.16);color:#fff;border-color:var(--gold);box-shadow:none}
.tmsg{display:flex;align-items:flex-start;gap:.9rem;margin-bottom:1.6rem}
.tav{flex:0 0 42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#bcd0ff,#7c8fe8);color:#0a0d24;font-family:'Cormorant Garamond',serif;font-size:1.4rem}
.bubble{position:relative;background:rgba(188,208,255,.14);border:1px solid #bcd0ff44;border-radius:6px 22px 22px 22px;padding:1rem 1.3rem;margin:0;max-width:36rem;font-size:1.05rem;line-height:1.7;color:#f2f4ff}
.bubble::before{content:"";position:absolute;left:-9px;top:12px;border:8px solid transparent;border-right-color:#bcd0ff44;border-left:0}
.tn{font-size:.9rem;color:#e7dcc0;margin-bottom:.35rem}
.bubble small{display:block;margin-top:.6rem;color:#a9b0d0}
.soon{text-align:center;padding:3rem 1rem;border:1px dashed #ffffff40;margin-top:1.2rem;color:var(--muted)}
.soon-t{font-family:'Great Vibes',cursive;font-size:2.8rem;color:#cfe0ff;margin-bottom:.4rem}

/* Moment media card helpers */
.moment-item{position:relative;overflow:hidden;border:1px solid #ffffff22}
.moment-item img, .moment-item video{width:100%;aspect-ratio:1;object-fit:cover;display:block}
.moment-del{position:absolute;top:4px;right:4px;background:rgba(0,0,0,0.7);color:#ff7788;border:0;font-size:.75rem;padding:2px 6px;cursor:pointer;border-radius:2px}
.moment-del:hover{background:#b91c1c;color:#fff}
</style>
</head>
<body class="<?= $initialOwner ? 'owner' : '' ?>">

<!-- ================= PAGE 1 : LANDING ================= -->
<section class="page active" id="landing">
  <div class="moon-orb" aria-hidden="true"></div>
  <header class="topbar"><div class="container d-flex justify-content-end">
    <button class="btn btn-gold btn-sm" id="landingAuthBtn" onclick="handleTopAuth()">Login / Sign up</button>
  </div></header>
  <div class="container hero"><div>
    <p class="hey">Heyy, hello!!! Welcome...</p>
    <h1>Manjusha K Madhavan</h1>
    <p>Step into my little corner of the world, where my studies, my work and my dreams sit beside quiet diary pages and bright, small moments I want to keep. Take a look around and leave a thought of&nbsp;your&nbsp;own.</p>
    <button class="btn btn-solid mt-4" id="heroEnterBtn" onclick="handleHeroEnter()">Come on in</button>
  </div></div>
</section>

<!-- ================= PAGE 2 : LOGIN / REGISTER ================= -->
<section class="page" id="login">
  <div class="login-box">
    <button class="btn btn-sm text-secondary p-0 mb-3" onclick="go('landing')">&larr; Back</button>
    <div class="nav-tabs-lite mb-3"><button class="on" id="tLogin" onclick="tab('in')">Sign in</button><button id="tSign" onclick="tab('up')">Register</button></div>
    <div class="mb-3" id="nameRow" style="display:none"><input class="form-control" id="uName" placeholder="Your name"></div>
    <div class="mb-3"><input class="form-control" type="email" id="uMail" placeholder="Email"></div>
    <div class="mb-3"><input class="form-control" type="password" id="uPass" placeholder="Password"></div>
    <button class="btn btn-solid w-100" id="authBtn" onclick="auth()">Sign in</button>
    <p class="small text-secondary mt-3 mb-0" id="authHint">New here? Register once, then sign in whenever you visit.</p>
  </div>
</section>

<!-- ================= PAGE 3 : HOME ================= -->
<section class="page" id="home">
  <div class="home-head">
    <div class="container pt-3">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <span class="brand">Welcome</span>
        <div><span class="me-3 small text-secondary" id="hello"><?= $initialUser ? 'Hi, ' . htmlspecialchars($initialUser['name']) : '' ?></span><button class="btn btn-gold btn-sm" onclick="logout()">Logout</button></div>
      </div>
      <div class="row align-items-center g-4">
        <div class="col-md-8 d-flex align-items-center gap-4">
          <img class="avatar" src="images/2023-1838.53.My Docs.jpg" alt="Manjusha K" onerror="this.onerror=null;this.src='images/moon.webp';">
          <div><h1 class="m-0">Manjusha K Madhavan</h1></div>
        </div>
      </div>
    </div>
  </div>

  <div class="container py-4">
    <!-- two main boxes -->
    <div class="row g-3">
      <div class="col-md-6"><button class="big-card" id="bPro" style="--bg:url(images/moon.webp)" onclick="showGroup('pro')"><h2>Professional</h2><span>Academics, experience and projects</span></button></div>
      <div class="col-md-6"><button class="big-card" id="bPer" style="--bg:url(images/moon.webp)" onclick="showGroup('per')"><h2>Personal</h2><span>Passion, diary and moments</span></button></div>
    </div>

    <!-- three boxes under Professional -->
    <div class="group mt-3" id="g-pro"><div class="row g-3">
      <div class="col-md-4"><button class="sub-card c-blue" style="--pos:10% 20%" onclick="panel('acad',this)"><h3>Academics</h3><small>Studies and certificates</small></button></div>
      <div class="col-md-4"><button class="sub-card c-teal" style="--pos:60% 60%" onclick="panel('exp',this)"><h3>Experience</h3><small>Teaching and internships</small></button></div>
      <div class="col-md-4"><button class="sub-card c-violet" style="--pos:90% 30%" onclick="panel('proj',this)"><h3>Projects</h3><small>What I have built</small></button></div>
    </div></div>

    <!-- three boxes under Personal -->
    <div class="group mt-3" id="g-per"><div class="row g-3">
      <div class="col-md-4"><button class="sub-card c-rose" style="--pos:30% 40%" onclick="panel('pass',this)"><h3>Passion</h3><small>Gallery</small></button></div>
      <div class="col-md-4"><button class="sub-card c-gold" style="--pos:50% 10%" onclick="panel('diary',this)"><h3>Diary</h3><small>Notes &amp; Special Date Memory</small></button></div>
      <div class="col-md-4"><button class="sub-card c-indigo" style="--pos:75% 70%" onclick="panel('mom',this)"><h3>Moments</h3><small>Videos &amp; Photos</small></button></div>
    </div></div>

    <!-- ===== PANELS ===== -->
    <div class="panel" id="p-acad">
      <h3>Academics</h3>
      <div class="row g-3 mt-1">
        <div class="col-md-6"><div class="fcard now" style="--a:#d8b878" data-k="2025"><span class="pill">Studying now</span><h4>M.Tech in Network Engineering</h4><div class="text-secondary">Government Engineering College, Barton Hill</div></div></div>
        <div class="col-md-6"><div class="fcard" style="--a:#6ea0ff" data-k="2023"><span class="pill">2019 &ndash; 2023</span><h4>B.Tech</h4><div class="text-secondary">College of Engineering Cherthala &middot; CGPA 7.08</div></div></div>
        <div class="col-md-6"><div class="fcard" style="--a:#5eead4" data-k="2024"><span class="pill">2023 &ndash; 2024</span><h4>Full Stack Web Development</h4><div class="text-secondary">Python, Django and Angular at Luminar Technolab, Kochi</div></div></div>
        <div class="col-md-6"><div class="fcard" style="--a:#ff9ccb" data-k="97%"><span class="pill">School</span><h4>RMHSS Malappuram</h4><div class="text-secondary">Class X with 97% and Class XII with 80.25%</div></div></div>
      </div>
      <a class="btn btn-gold btn-sm mt-3" target="_blank" rel="noopener" href="https://www.linkedin.com/in/manjushakmadhavan">View LinkedIn</a>
    </div>

    <div class="panel" id="p-exp">
      <h3>Experience</h3>
      <div class="row g-3 mt-1">
        <div class="col-12"><div class="fcard now" style="--a:#d8b878" data-k="Now"><span class="pill">Since Dec 2025</span><h4>Data Analytics Faculty, Freelance</h4><div class="text-secondary">Teaching data analytics with Beat Education, alongside my M.Tech.</div></div></div>
        <div class="col-md-6"><div class="fcard" style="--a:#5eead4" data-k="AI"><span class="pill">2024 &ndash; 2025</span><h4>Data Science &amp; AI Faculty</h4><div class="text-secondary">KELTRON with Cysonet Technologies, Trivandrum</div></div></div>
        <div class="col-md-6"><div class="fcard" style="--a:#c4a1ff" data-k="IoT"><span class="pill">Early training</span><h4>Hands-on learning</h4><div class="text-secondary">IoT and Raspberry Pi at QuoLabs, and a day at KSEB&rsquo;s Neriamangalam Power House with KMML.</div></div></div>
      </div>
    </div>

    <div class="panel" id="p-proj">
      <h3>Projects</h3>
      <div class="row g-3 mt-1">
        <div class="col-md-4"><div class="fcard" style="--a:#e11d48"><div class="pbanner">iDonate</div><div class="text-secondary mb-2">Connects donors, receivers, organisations and hospitals so blood and organ availability is easy to find.</div><span class="tag">Major project</span><span class="tag">Web app</span></div></div>
        <div class="col-md-4"><div class="fcard" style="--a:#7c3aed"><div class="pbanner">LGBTQ Matrimony</div><div class="text-secondary mb-2">A matrimony platform with auto-matching and interest-based search.</div><span class="tag">Mini project</span><span class="tag">Web app</span></div></div>
        <div class="col-md-4"><div class="fcard" style="--a:#0d9488"><div class="pbanner">PHC Application</div><div class="text-secondary mb-2">A desktop app that keeps patient, staff and doctor records in one place.</div><span class="tag">Minor project</span><span class="tag">NetBeans</span><span class="tag">MySQL</span></div></div>
      </div>
      <a class="btn btn-gold btn-sm mt-3" target="_blank" rel="noopener" href="https://github.com/Manjusha-k-Madhavan">View GitHub</a>
    </div>

    <div class="panel" id="p-pass">
      <h3>Passion &ndash; Gallery</h3>
      <div class="soon"><div class="soon-t">Upcoming</div><p class="mb-0">The dance gallery is upcoming. Photos will appear here soon.</p></div>
    </div>

    <div class="panel" id="p-diary">
      <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
        <h3 class="m-0">Diary</h3>
        <div class="dtabs"><button class="on" onclick="dtab('notes',this)">Notes</button><button onclick="dtab('thoughts',this)">Thoughts today</button><button onclick="dtab('dates',this)">Special dates</button></div>
      </div>
      
      <!-- Notes Tab -->
      <div class="dpane on" id="dp-notes">
        <div class="owner-only mb-3">
          <textarea id="noteText" class="form-control mb-2" rows="2" placeholder="A note for today"></textarea>
          <button class="btn btn-solid btn-sm" id="noteBtn" onclick="saveNote()">Save note</button>
          <button class="btn btn-sm btn-outline-secondary ms-2" id="cancelNoteBtn" style="display:none;border-radius:0" onclick="cancelEditNote()">Cancel</button>
        </div>
        <div id="notes" class="notegrid"></div>
      </div>

      <!-- Thoughts Tab -->
      <div class="dpane" id="dp-thoughts">
        <h4 class="mb-1"><span aria-hidden="true">&#128173;</span> Thoughts of the day</h4>
        <p class="text-secondary mb-3">Leave a thought for today. It stays here for 24 hours. (Owner can delete any thought)</p>
        <div class="row g-2 mb-3">
          <div class="col-md-3"><input class="form-control form-control-sm" id="qName" placeholder="Your name (optional)"></div>
          <div class="col-md-7"><input class="form-control form-control-sm" id="qText" placeholder="Your thought of the day"></div>
          <div class="col-md-2"><button class="btn btn-gold btn-sm w-100" onclick="addThought()">Post</button></div>
        </div>
        <div id="thoughts"></div>
      </div>

      <!-- Special Dates Tab -->
      <div class="dpane" id="dp-dates">
        <div class="owner-only lock mb-3">
          <h5 class="mb-2" style="font-family:'Cormorant Garamond',serif;color:var(--gold)">Add New Special Date</h5>
          <input class="form-control form-control-sm mb-2" id="dTitle" placeholder="Title, e.g. A small day that meant a lot">
          <input class="form-control form-control-sm mb-2" type="date" id="dDate">
          <textarea class="form-control mb-2" id="dMem" rows="3" placeholder="The core memory of this date"></textarea>
          <button class="btn btn-solid btn-sm" onclick="addDate()">Add special date</button>
        </div>
        <div id="dates"></div>
      </div>
    </div>

    <!-- Moments Panel -->
    <div class="panel" id="p-mom">
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h3 class="m-0">Moments</h3>
        <div class="owner-only">
          <button class="btn btn-gold btn-sm" onclick="toggleAddMomentBox()">+ Add Photo/Video</button>
        </div>
      </div>

      <!-- Owner upload / add media form -->
      <div class="owner-only lock my-3" id="addMomentBox" style="display:none">
        <h5 style="font-family:'Cormorant Garamond',serif;color:var(--gold);margin-bottom:.8rem">Add Moment (Photo or Video)</h5>
        <div class="row g-2">
          <div class="col-md-4">
            <label class="small text-secondary mb-1">Upload File (Photo or Video)</label>
            <input class="form-control form-control-sm" type="file" id="momentFile" accept="image/*,video/*">
          </div>
          <div class="col-md-4">
            <label class="small text-secondary mb-1">Or Direct Media URL</label>
            <input class="form-control form-control-sm" type="text" id="momentUrl" placeholder="images/fly.jpg or https://...">
          </div>
          <div class="col-md-4">
            <label class="small text-secondary mb-1">Caption / Title</label>
            <input class="form-control form-control-sm" type="text" id="momentTitle" placeholder="Moment title">
          </div>
          <div class="col-12 d-flex align-items-center gap-3 mt-2">
            <label class="d-flex align-items-center gap-2 small text-light">
              <input type="checkbox" id="momentIsPrivate"> Make this a <b>Private Moment</b> (Requires my approval to view)
            </label>
            <button class="btn btn-solid btn-sm ms-auto" onclick="submitMoment()">Save Moment</button>
          </div>
        </div>
      </div>

      <div class="nav-tabs-lite my-3">
        <button class="on" id="mPub" onclick="mtab('pub')">Public</button>
        <button id="mPriv" onclick="mtab('priv')">Private</button>
      </div>

      <!-- Public moments gallery -->
      <div id="m-pub" class="gal"></div>

      <!-- Private moments gallery & approval status -->
      <div id="m-priv" style="display:none">
        <div id="privBox"></div>
        <div id="privGal" class="gal mt-3" style="display:none"></div>
      </div>
    </div>
  </div>
</section>

<div class="toast-lite" id="toast"></div>

<script>
/**
 * Frontend Application Script with PHP + MySQL Backend Integration
 */
let me = <?= $initialUser ? json_encode([
    'id'       => (int)$initialUser['id'],
    'name'     => $initialUser['name'],
    'email'    => $initialUser['email'],
    'role'     => $initialUser['role'],
    'is_owner' => $initialOwner
]) : 'null' ?>;

let mode = 'in';
let editId = null;
let currentMomTab = 'pub';

const $ = id => document.getElementById(id);
const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
const isOwner = () => !!(me && me.is_owner);

function say(text) {
  const e = $('toast');
  e.textContent = text;
  e.style.display = 'block';
  clearTimeout(say._t);
  say._t = setTimeout(() => e.style.display = 'none', 3000);
}

function go(id) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  const target = $(id);
  if (target) {
    target.classList.add('active');
    window.scrollTo(0, 0);
  }
}

function handleTopAuth() {
  if (me) {
    go('home');
  } else {
    go('login');
  }
}

function handleHeroEnter() {
  if (me) {
    go('home');
  } else {
    go('login');
  }
}

/* ================= AUTHENTICATION ================= */
function tab(m) {
  mode = m;
  const up = (m === 'up');
  $('tLogin').classList.toggle('on', !up);
  $('tSign').classList.toggle('on', up);
  $('nameRow').style.display = up ? 'block' : 'none';
  $('authBtn').textContent = up ? 'Register' : 'Sign in';
  $('authHint').textContent = up ? 'Register once. Next time, just sign in.' : 'New here? Register once, then sign in whenever you visit.';
}

async function auth() {
  const email = $('uMail').value.trim();
  const pass  = $('uPass').value;
  const name  = $('uName').value.trim();

  if (!email || !pass) {
    say('Enter your email and password.');
    return;
  }
  if (mode === 'up' && !name) {
    say('Enter your name.');
    return;
  }

  try {
    const payload = (mode === 'up')
      ? { action: 'register', name, email, password: pass }
      : { action: 'login', email, password: pass };

    const res = await fetch('api/auth.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });

    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Authentication failed.');
      return;
    }

    me = data.user;
    applyUserState();
    $('uMail').value = '';
    $('uPass').value = '';
    $('uName').value = '';
    say(data.message || 'Welcome!');
    go('home');
    loadAllData();
  } catch (err) {
    say('Network or server error during sign in.');
  }
}

async function logout() {
  try {
    await fetch('api/auth.php?action=logout');
  } catch (e) {}
  me = null;
  applyUserState();
  say('Signed out.');
  go('landing');
}

function applyUserState() {
  const isOwn = isOwner();
  document.body.classList.toggle('owner', isOwn);
  $('hello').textContent = me ? 'Hi, ' + me.name : '';
  const topAuth = $('landingAuthBtn');
  if (topAuth) {
    topAuth.textContent = me ? 'Go to Home' : 'Login / Sign up';
  }
  const heroBtn = $('heroEnterBtn');
  if (heroBtn) {
    heroBtn.textContent = me ? 'Go to Home' : 'Come on in';
  }
}

/* ================= NAVIGATION & PANELS ================= */
function showGroup(g) {
  ['pro', 'per'].forEach(k => {
    const e = $('g-' + k);
    e.classList.remove('show');
    if (k === g) {
      void e.offsetWidth;
      e.classList.add('show');
    }
  });
  $('bPro').classList.toggle('on', g === 'pro');
  $('bPer').classList.toggle('on', g === 'per');
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('show'));
  document.querySelectorAll('.sub-card').forEach(c => c.classList.remove('on'));
  setTimeout(() => $('g-' + g).scrollIntoView({ behavior: 'smooth', block: 'center' }), 80);
}

function panel(id, btn) {
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('show'));
  const p = $('p-' + id);
  p.classList.add('show');
  document.querySelectorAll('.sub-card').forEach(c => c.classList.remove('on'));
  btn.classList.add('on');
  p.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function dtab(id, btn) {
  document.querySelectorAll('.dpane').forEach(p => p.classList.remove('on'));
  $('dp-' + id).classList.add('on');
  document.querySelectorAll('.dtabs button').forEach(b => b.classList.remove('on'));
  btn.classList.add('on');
}

function mtab(m) {
  currentMomTab = m;
  const isPub = (m === 'pub');
  $('mPub').classList.toggle('on', isPub);
  $('mPriv').classList.toggle('on', !isPub);
  $('m-pub').style.display = isPub ? 'grid' : 'none';
  $('m-priv').style.display = isPub ? 'none' : 'block';
  loadMoments();
}

function toggleAddMomentBox() {
  const box = $('addMomentBox');
  box.style.display = (box.style.display === 'none' || !box.style.display) ? 'block' : 'none';
}

/* ================= 1. DIARY NOTES ================= */
async function loadNotes() {
  try {
    const res = await fetch('api/notes.php');
    const data = await res.json();
    if (!data.success) return;

    const own = isOwner();
    const container = $('notes');
    if (!data.notes || !data.notes.length) {
      container.innerHTML = '<p class="text-secondary">No notes yet.</p>';
      return;
    }

    container.innerHTML = data.notes.map(n => `
      <div class="sticky" id="note-${esc(n.id)}">
        ${esc(n.t)}
        <small>
          ${esc(n.d)}
          ${own ? ` &middot; <a href="#" onclick="editNote('${esc(n.id)}');return false">edit</a> &middot; <a href="#" onclick="delNote('${esc(n.id)}');return false">delete</a>` : ''}
        </small>
      </div>
    `).join('');
  } catch (e) {
    console.error('loadNotes error:', e);
  }
}

async function saveNote() {
  const content = $('noteText').value.trim();
  if (!content) {
    say('Write a note first.');
    return;
  }

  try {
    const res = await fetch('api/notes.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'save', id: editId, content })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not save note.');
      return;
    }

    $('noteText').value = '';
    editId = null;
    $('noteBtn').textContent = 'Save note';
    $('cancelNoteBtn').style.display = 'none';
    say(data.message || 'Note saved.');
    loadNotes();
  } catch (e) {
    say('Error saving note.');
  }
}

function editNote(id) {
  const noteEl = $('note-' + id);
  if (!noteEl) return;
  // Get text content without the small date text
  const clone = noteEl.cloneNode(true);
  const small = clone.querySelector('small');
  if (small) small.remove();
  editId = id;
  $('noteText').value = clone.textContent.trim();
  $('noteBtn').textContent = 'Update note';
  $('cancelNoteBtn').style.display = 'inline-block';
  $('noteText').focus();
}

function cancelEditNote() {
  editId = null;
  $('noteText').value = '';
  $('noteBtn').textContent = 'Save note';
  $('cancelNoteBtn').style.display = 'none';
}

async function delNote(id) {
  if (!confirm('Are you sure you want to delete this note?')) return;
  try {
    const res = await fetch('api/notes.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'delete', id })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not delete note.');
      return;
    }
    say('Note deleted.');
    loadNotes();
  } catch (e) {
    say('Error deleting note.');
  }
}

/* ================= 2. THOUGHTS OF THE DAY ================= */
async function loadThoughts() {
  try {
    const res = await fetch('api/thoughts.php');
    const data = await res.json();
    if (!data.success) return;

    const container = $('thoughts');
    if (!data.thoughts || !data.thoughts.length) {
      container.innerHTML = '<p class="text-secondary">No thoughts today. Be the first.</p>';
      return;
    }

    const own = isOwner();
    container.innerHTML = data.thoughts.map(t => {
      const initial = esc(t.n ? t.n.trim().charAt(0).toUpperCase() : 'V');
      // Owner can delete ANY thought; or author can delete their own
      const showDelete = own || t.can_delete;
      return `
        <div class="tmsg">
          <div class="tav">${initial}</div>
          <div class="bubble">
            <div class="tn">${esc(t.n)}</div>
            ${esc(t.t)}
            <small>
              ${t.hours_left}h left
              ${showDelete ? ` &middot; <a href="#" onclick="delThought('${esc(t.id)}');return false">delete</a>` : ''}
            </small>
          </div>
        </div>
      `;
    }).join('');
  } catch (e) {
    console.error('loadThoughts error:', e);
  }
}

async function addThought() {
  const thought = $('qText').value.trim();
  const name = $('qName').value.trim();

  if (!thought) {
    say('Write something first.');
    return;
  }

  try {
    const res = await fetch('api/thoughts.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'add', t: thought, n: name })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not post thought.');
      return;
    }

    $('qText').value = '';
    say('Thought posted for 24 hours.');
    loadThoughts();
  } catch (e) {
    say('Error posting thought.');
  }
}

async function delThought(id) {
  try {
    const res = await fetch('api/thoughts.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'delete', id })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not delete thought.');
      return;
    }
    say('Thought deleted.');
    loadThoughts();
  } catch (e) {
    say('Error deleting thought.');
  }
}

/* ================= 3. SPECIAL DATES & CHAT ================= */
async function loadDates() {
  try {
    const res = await fetch('api/dates.php');
    const data = await res.json();
    if (!data.success) return;

    const container = $('dates');
    if (!data.dates || !data.dates.length) {
      container.innerHTML = '<p class="text-secondary">No special dates yet.</p>';
      return;
    }

    const own = isOwner();

    container.innerHTML = data.dates.map(d => {
      const dt = new Date(d.date);
      const dayNum = !isNaN(dt.getTime()) ? dt.getDate() : '--';
      const monthYear = !isNaN(dt.getTime())
        ? dt.toLocaleString('en', { month: 'short' }) + ' ' + dt.getFullYear()
        : '';

      let bodyHtml = '';

      if (own) {
        // OWNER VIEW: Full memory + requests list + chat
        bodyHtml = `<p class="mb-2">${esc(d.mem)}</p>`;

        if (d.requests && d.requests.length) {
          bodyHtml += d.requests.map(r => {
            const isUnlockPending = (r.status === 'pending');
            const isUnlockApproved = (r.status === 'approved');
            const isChatPending = (r.chat === 'pending');
            const isChatApproved = (r.chat === 'approved');

            return `
              <div class="mt-2 small border-top border-secondary border-opacity-25 pt-2">
                <b>${esc(r.name)}</b> (${esc(r.email)}) &ndash;
                <span>unlock: <b>${esc(r.status)}</b></span>
                ${isUnlockPending ? `
                  <button class="btn btn-gold btn-sm ms-2" onclick="setReq('${esc(r.id)}','approved')">Allow</button>
                  <button class="btn btn-sm text-secondary" onclick="setReq('${esc(r.id)}','declined')">Not now</button>
                ` : ''}

                ${isUnlockApproved && isChatPending ? `
                  <div class="mt-1 text-warning">
                    Wants to chat about this date:
                    <button class="btn btn-gold btn-sm ms-2" onclick="setChat('${esc(r.id)}','approved')">Open chat</button>
                    <button class="btn btn-sm text-secondary" onclick="setChat('${esc(r.id)}','declined')">Not now</button>
                  </div>
                ` : ''}

                ${isChatApproved ? chatHtml(r) : ''}
              </div>
            `;
          }).join('');
        }
      } else {
        // VISITOR VIEW: Locked until approved
        if (!me) {
          bodyHtml = `
            <div class="lock">&#128274; This memory is private.
              <button class="btn btn-gold btn-sm ms-2" onclick="go('login')">Sign in to ask</button>
            </div>
          `;
        } else if (!d.req_status) {
          bodyHtml = `
            <div class="lock">&#128274; This memory is private.
              <button class="btn btn-gold btn-sm ms-2" onclick="reqDate('${esc(d.id)}')">Ask to unlock</button>
            </div>
          `;
        } else if (d.req_status === 'pending') {
          bodyHtml = '<div class="lock">Sent. Waiting for Manjusha to say yes.</div>';
        } else if (d.req_status === 'declined') {
          bodyHtml = '<div class="lock">Not opened this time.</div>';
        } else {
          // APPROVED: Show memory + chat option
          bodyHtml = `<p>${esc(d.mem)}</p>`;
          if (!d.chat_status || d.chat_status === 'none') {
            bodyHtml += `<button class="btn btn-gold btn-sm mt-1" onclick="reqChat('${esc(d.req_id)}')">Ask to chat with me about this</button>`;
          } else if (d.chat_status === 'pending') {
            bodyHtml += '<div class="lock mt-2">Sent. Waiting for Manjusha to open the chat.</div>';
          } else if (d.chat_status === 'declined') {
            bodyHtml += '<div class="lock mt-2">The chat was not opened this time.</div>';
          } else if (d.chat_status === 'approved') {
            bodyHtml += chatHtml({ id: d.req_id, msgs: d.msgs || [] });
          }
        }
      }

      return `
        <div class="mem">
          <div class="dday">
            <b>${dayNum}</b>
            <span>${monthYear}</span>
          </div>
          <div class="dbody">
            <h5>${esc(d.title)}</h5>
            ${own ? `<small><a href="#" onclick="delDate('${esc(d.id)}');return false">delete</a></small>` : ''}
            <div class="mt-2">${bodyHtml}</div>
          </div>
        </div>
      `;
    }).join('');
  } catch (e) {
    console.error('loadDates error:', e);
  }
}

function chatHtml(r) {
  const msgsHtml = (r.msgs && r.msgs.length)
    ? r.msgs.map(m => `
        <div class="msg">
          <b>${esc(m.from)}:</b> ${esc(m.t)}
          ${m.time ? `<small>${esc(m.time)}</small>` : ''}
        </div>
      `).join('')
    : '<div class="msg text-secondary">Say hello about this date.</div>';

  return `
    <div class="chat">
      <div id="chat-msgs-${esc(r.id)}">${msgsHtml}</div>
      <div class="input-group input-group-sm mt-2">
        <input class="form-control" id="c-${esc(r.id)}" placeholder="Type a message..." onkeydown="if(event.key==='Enter')sendMsg('${esc(r.id)}')">
        <button class="btn btn-gold" onclick="sendMsg('${esc(r.id)}')">Send</button>
      </div>
    </div>
  `;
}

async function addDate() {
  const title = $('dTitle').value.trim();
  const date  = $('dDate').value;
  const mem   = $('dMem').value.trim();

  if (!title || !date || !mem) {
    say('Fill title, date and memory.');
    return;
  }

  try {
    const res = await fetch('api/dates.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'add_date', title, date, memory: mem })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not add date.');
      return;
    }

    $('dTitle').value = '';
    $('dDate').value = '';
    $('dMem').value = '';
    say('Special date added.');
    loadDates();
  } catch (e) {
    say('Error adding special date.');
  }
}

async function delDate(id) {
  if (!confirm('Are you sure you want to delete this special date?')) return;
  try {
    const res = await fetch('api/dates.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'delete_date', id })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not delete date.');
      return;
    }
    say('Special date deleted.');
    loadDates();
  } catch (e) {
    say('Error deleting date.');
  }
}

async function reqDate(dateId) {
  if (!me) {
    say('Please sign in first.');
    go('login');
    return;
  }
  try {
    const res = await fetch('api/dates.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'request_unlock', date_id: dateId })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Request failed.');
      return;
    }
    say('Your ask was sent to Manjusha.');
    loadDates();
  } catch (e) {
    say('Error sending unlock ask.');
  }
}

async function setReq(reqId, status) {
  try {
    const res = await fetch('api/dates.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'set_unlock_status', request_id: reqId, status })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not update status.');
      return;
    }
    say(data.message || 'Updated status.');
    loadDates();
  } catch (e) {
    say('Error updating request.');
  }
}

async function reqChat(reqId) {
  try {
    const res = await fetch('api/dates.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'request_chat', request_id: reqId })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not send chat ask.');
      return;
    }
    say('Chat ask sent to Manjusha.');
    loadDates();
  } catch (e) {
    say('Error sending chat request.');
  }
}

async function setChat(reqId, status) {
  try {
    const res = await fetch('api/dates.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'set_chat_status', request_id: reqId, status })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not update chat status.');
      return;
    }
    say(data.message || 'Chat status updated.');
    loadDates();
  } catch (e) {
    say('Error setting chat status.');
  }
}

async function sendMsg(reqId) {
  const input = $('c-' + reqId);
  const text = input ? input.value.trim() : '';
  if (!text) return;

  try {
    const res = await fetch('api/dates.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'send_message', request_id: reqId, message: text })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not send message.');
      return;
    }
    input.value = '';
    loadDates();
  } catch (e) {
    say('Error sending message.');
  }
}

/* ================= 4. MOMENTS (PUBLIC & PRIVATE) ================= */
async function loadMoments() {
  try {
    const res = await fetch('api/moments.php');
    const data = await res.json();
    if (!data.success) return;

    const own = isOwner();

    // Render Public Gallery
    const pubContainer = $('m-pub');
    if (data.public_moments && data.public_moments.length) {
      pubContainer.innerHTML = data.public_moments.map(m => renderMomentMedia(m, own)).join('');
    } else {
      pubContainer.innerHTML = '<p class="text-secondary p-3">No public moments added yet.</p>';
    }

    // Render Private Section
    const privBox = $('privBox');
    const privGal = $('privGal');

    if (own) {
      // Owner view: list of asks + full private gallery
      let asksHtml = '';
      if (data.requests && data.requests.length) {
        asksHtml = data.requests.map(r => `
          <div class="small mb-2 border-bottom border-secondary border-opacity-25 pb-2">
            <b>${esc(r.name)}</b> (${esc(r.email)}) &ndash; status: <b>${esc(r.status)}</b>
            ${r.status === 'pending' ? `
              <button class="btn btn-gold btn-sm ms-2" onclick="setPriv('${esc(r.id)}','approved')">Allow</button>
              <button class="btn btn-sm text-secondary" onclick="setPriv('${esc(r.id)}','declined')">Not now</button>
            ` : ''}
          </div>
        `).join('');
      } else {
        asksHtml = '<p class="small text-secondary">No private viewing requests yet.</p>';
      }

      privBox.innerHTML = `
        <h6 class="text-gold mb-2" style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;color:var(--gold)">Private Viewing Asks:</h6>
        ${asksHtml}
      `;

      privGal.style.display = 'grid';
      if (data.private_moments && data.private_moments.length) {
        privGal.innerHTML = data.private_moments.map(m => renderMomentMedia(m, true)).join('');
      } else {
        privGal.innerHTML = '<div class="ph" onclick="toggleAddMomentBox()">+ Add Private Photo / Video</div>';
      }
    } else {
      // Visitor view: check access
      if (!me) {
        privBox.innerHTML = `
          <div class="lock">&#128274; Private moments need my approval.
            <button class="btn btn-gold btn-sm ms-2" onclick="go('login')">Sign in to ask</button>
          </div>
        `;
        privGal.style.display = 'none';
      } else if (!data.request_status) {
        privBox.innerHTML = `
          <div class="lock">&#128274; Private moments need my approval.
            <button class="btn btn-gold btn-sm ms-2" onclick="reqPriv()">Ask to view</button>
          </div>
        `;
        privGal.style.display = 'none';
      } else if (data.request_status === 'pending') {
        privBox.innerHTML = '<div class="lock">Sent. Waiting for Manjusha to say yes.</div>';
        privGal.style.display = 'none';
      } else if (data.request_status === 'declined') {
        privBox.innerHTML = '<div class="lock">Not opened this time.</div>';
        privGal.style.display = 'none';
      } else if (data.has_private_access) {
        privBox.innerHTML = '<div class="small text-success mb-2">&#10003; Private moments unlocked by Manjusha.</div>';
        privGal.style.display = 'grid';
        if (data.private_moments && data.private_moments.length) {
          privGal.innerHTML = data.private_moments.map(m => renderMomentMedia(m, false)).join('');
        } else {
          privGal.innerHTML = '<p class="text-secondary">No private moments available right now.</p>';
        }
      }
    }
  } catch (e) {
    console.error('loadMoments error:', e);
  }
}

function renderMomentMedia(m, allowDelete) {
  const isVideo = (m.type === 'video');
  const mediaTag = isVideo
    ? `<video src="${esc(m.media_url)}" controls></video>`
    : `<img src="${esc(m.media_url)}" alt="${esc(m.title || 'Moment')}" loading="lazy">`;

  return `
    <div class="moment-item" title="${esc(m.title || '')}">
      ${mediaTag}
      ${allowDelete ? `<button class="moment-del" onclick="delMoment('${esc(m.id)}')">&#10005;</button>` : ''}
    </div>
  `;
}

async function reqPriv() {
  if (!me) {
    say('Please sign in first.');
    go('login');
    return;
  }
  try {
    const res = await fetch('api/moments.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'request_access' })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not send request.');
      return;
    }
    say('Your ask was sent to Manjusha.');
    loadMoments();
  } catch (e) {
    say('Error sending private view ask.');
  }
}

async function setPriv(reqId, status) {
  try {
    const res = await fetch('api/moments.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'set_access_status', request_id: reqId, status })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not update status.');
      return;
    }
    say(data.message || 'Status updated.');
    loadMoments();
  } catch (e) {
    say('Error setting private status.');
  }
}

async function submitMoment() {
  const fileInput = $('momentFile');
  const urlInput = $('momentUrl');
  const titleInput = $('momentTitle');
  const isPrivate = $('momentIsPrivate').checked ? 1 : 0;

  const hasFile = fileInput.files && fileInput.files.length > 0;
  const hasUrl = urlInput.value.trim().length > 0;

  if (!hasFile && !hasUrl) {
    say('Select a photo/video file or enter a media URL.');
    return;
  }

  const formData = new FormData();
  formData.append('action', 'add_moment');
  formData.append('title', titleInput.value.trim() || 'Moment');
  formData.append('is_private', isPrivate);

  if (hasFile) {
    formData.append('media_file', fileInput.files[0]);
  } else {
    formData.append('media_url', urlInput.value.trim());
  }

  try {
    const res = await fetch('api/moments.php', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not add moment.');
      return;
    }

    fileInput.value = '';
    urlInput.value = '';
    titleInput.value = '';
    $('momentIsPrivate').checked = false;
    $('addMomentBox').style.display = 'none';
    say('Moment added successfully.');
    loadMoments();
  } catch (e) {
    say('Error uploading moment.');
  }
}

async function delMoment(id) {
  if (!confirm('Are you sure you want to delete this moment?')) return;
  try {
    const res = await fetch('api/moments.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'delete_moment', id })
    });
    const data = await res.json();
    if (!data.success) {
      say(data.error || 'Could not delete moment.');
      return;
    }
    say('Moment deleted.');
    loadMoments();
  } catch (e) {
    say('Error deleting moment.');
  }
}

/* ================= INITIALIZATION ================= */
function loadAllData() {
  loadNotes();
  loadThoughts();
  loadDates();
  loadMoments();
}

// Check session on initial load and load data
window.addEventListener('DOMContentLoaded', async () => {
  applyUserState();
  loadAllData();

  // Periodic lightweight refresh for live chats and asks every 8 seconds
  setInterval(() => {
    const activePage = document.querySelector('.page.active');
    if (activePage && activePage.id === 'home') {
      const activePanel = document.querySelector('.panel.show');
      if (activePanel) {
        if (activePanel.id === 'p-diary') {
          loadThoughts();
          loadDates();
        } else if (activePanel.id === 'p-mom') {
          loadMoments();
        }
      }
    }
  }, 8000);
});
</script>
</body>
</html>
