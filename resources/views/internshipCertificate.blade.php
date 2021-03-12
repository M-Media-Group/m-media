@extends('layouts.clean')
@section('title', "Congratulations ".$internshipCertificate->internship->user->name."!")
@section('meta_description', "It's been tough. It's been rough. But damn ".$internshipCertificate->internship->user->name.", you've made some really cool stuff.")
@section('meta_image', config('app.url').'/images/internship/team_love.svg')

@section('above_container')
<div class="header-section" onclick="initBurst();" style="position: relative; height:70vh;background: var(--white);">
{{--     <div style="height: 250px; margin: 0 auto; display: flex">
        <img src="/images/internship/intern.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
    </div> --}}
    <h1 id="heading_text" class="u-center u-center-text">Congratulations {{$internshipCertificate->internship->user->name}}</h1>
    <p class="u-center u-center-text" id="heading_subtext" style="opacity: 0;">It's been tough. It's been rough. But damn {{$internshipCertificate->internship->user->name}}, you've made some really cool stuff.</p>
    <a href="#" class="small" id="confetti_action" style="opacity: 0;">Click for more confetti</a>
<canvas id="canvas"></canvas>
</div>
<div class="header-section" style="background: var(--white);">
  <h2 class="u-center">In the past 2 months, you have done a lot</h2>

  <div class="section-img section-img-spacer">
    <img src="/images/internship/growth.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
  </div>
  <h3 class="u-center">You've demonstrated exceptional personal growth</h3>

  <div class="section-img section-img-spacer">
    <img src="/images/internship/problem_solving.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
  </div>
  <h3 class="u-center">You exhibited inherent discipline and problem solving</h3>

  <div class="section-img section-img-spacer">
    <img src="/images/internship/party.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
  </div>
  <h3 class="u-center">You have shown a powerful drive to succeed among our ranks</h3>

</div>

<div class="header-section bg-primary">
  <h2 class="u-center">Most importantly, you became a valued member of our team</h2>

  <div class="section-img">
    <img src="/images/internship/team_love.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
  </div>

  <p class="u-center" style="margin-top: 3rem;">Even though at times you might have felt that you were playing catch-up with the team, know that you have equally taught us many things too.</p>
  <p class="u-center">Your candour helped further develop the M Media internship program, your passion helped re-ignite our own, and your dedication to the company has left us in awe.</p>
  <p class="u-center">As much anticipation as you may have had for each coming day, we had an equal excitement getting to work with you.</p>
</div>

<div class="header-section bg-secondary">
  <div class="section-img">
    <img src="/images/internship/work_together.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
  </div>
  <h2 class="u-center">Thank you for sharing all the laughs, the struggles, and the triumphs with us</h2>
  <p class="u-center">It’s been probably the best roller-coaster ever - and it doesn’t even have a height limit!</p>
  <p class="u-center">With over 3,000 messages exchanged back and forth, we’ve covered every human emotion there is to cover - and boy oh boy has it been fun.</p>
</div>

<div class="header-section">
  <h2 class="u-center">We’re happy to award you our M Media Internship Certificate</h2>
  <p class="u-center">You've earned it. Share on your LinkedIn profile, print and hang on your wall, or just bookmark it. It's yours forever now!</p>
  <div class="u-limit-max-width u-center">
    <a class="button button-primary" href="/internship-certificates/{{$internshipCertificate->uuid}}" target="_BLANK">Open the certificate</a>
    @if (Auth::user() && Auth::user()->can('show', $internshipCertificate->internship))
      <a class="button" href="https://linkedin.com/profile/add?startTask=CERTIFICATION_NAME&name=Internship%20Certificate%20of%20Completion&organizationId=28392415&issueYear={{ $internshipCertificate->created_at->format('Y') }}&issueMonth={{ $internshipCertificate->created_at->format('m') }}&certId={{$internshipCertificate->uuid}}&certUrl={{config('app.url') . '/internship-certificates/' . $internshipCertificate->uuid}}" target="_BLANK">Add to LinkedIn</a>
    @endif
  </div>
</div>

<div class="header-section bg-secondary">
  <h2 class="u-center">{{$internshipCertificate->personal_message_title}}</h2>
  <p class="u-center">{{$internshipCertificate->personal_message_body}}</p>
  <p class="u-center">
    <img src="/images/internship/white_signature.svg" style="height: 100%; margin-top:3rem;" alt="Shop" />
    Michał W. Founder of M Media
  </p>
</div>
@endsection

@section('footer_scripts')
<style type="text/css">
  .mt-0 {
    margin-top: 0;
  }

  .section-img {
    height: 250px;
    margin-left: auto;
    margin-right: auto;
    display: flex;
  }

  .section-img-spacer {
    margin-top: 13rem;
  }

  canvas {
    top:0;
    bottom:0;
    left:0;
    right:0;
    height: 100%;
    pointer-events: none;
    position: absolute;
    z-index: 2;
  }

  #heading_text, #heading_subtext {
   -webkit-transition: opacity .5s ease-in-out;
   -moz-transition: opacity .5s ease-in-out;
   -ms-transition: opacity .5s ease-in-out;
   -o-transition: opacity .5s ease-in-out;
   transition: opacity .5s ease-in-out;
}
#confetti_action {
  position: absolute;
  left:3rem;
  bottom:1rem;
}
</style>
<script type="text/javascript" charset="utf-8" async defer>
// ammount to add on each button press
const confettiCount = 200;

// "physics" variables
const gravityConfetti = 0.2;
const dragConfetti = 0.075;
const terminalVelocity = 2;

// init other global elements
const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");
let animation_played = false;
canvas.width = canvas.parentElement.clientWidth;
canvas.height = canvas.parentElement.clientHeight;
let cx = ctx.canvas.width / 2;
let cy = ctx.canvas.height / 2;

// add Confetto objects to arrays to draw them
let confetti = [];

// colors, back side is darker for confetti flipping
const colors = [
  { front: "#eb4647", back: "#dc1819" }, // Purple
  { front: "#246eb9", back: "#1d5894" }, // Light Blue
  { front: "#fff", back: "#f3f3f3" } // Light Blue
];

// helper function to pick a random number within a range
randomRange = (min, max) => Math.random() * (max - min) + min;

// helper function to get initial velocities for confetti
// this weighted spread helps the confetti look more realistic
initConfettoVelocity = (xRange, yRange) => {
  const x = randomRange(xRange[0], xRange[1]);
  const range = yRange[1] - yRange[0] + 1;
  let y =
    yRange[1] - Math.abs(randomRange(0, range) + randomRange(0, range) - range);
  if (y >= yRange[1] - 1) {
    // Occasional confetto goes higher than the max
    y += Math.random() < 0.25 ? randomRange(1, 3) : 0;
  }
  return { x: x, y: -y };
};

// Confetto Class
function Confetto() {
  this.randomModifier = randomRange(0, 99);
  this.color = colors[Math.floor(randomRange(0, colors.length))];
  this.dimensions = {
    x: randomRange(5, 9),
    y: randomRange(8, 15)
  };
  this.position = {
    x: randomRange(
      canvas.width / 2 - canvas.offsetWidth / 4,
      canvas.width / 2 + canvas.offsetWidth / 4
    ),
    y: randomRange(canvas.height, 0)
  };
  this.rotation = randomRange(0, 2 * Math.PI);
  this.scale = {
    x: 1,
    y: 1
  };
  this.velocity = initConfettoVelocity([-9, 9], [6, 11]);
}
Confetto.prototype.update = function () {
  // apply forces to velocity
  this.velocity.x -= this.velocity.x * dragConfetti;
  this.velocity.y = Math.min(
    this.velocity.y + gravityConfetti,
    terminalVelocity
  );
  this.velocity.x += Math.random() > 0.5 ? Math.random() : -Math.random();

  // set position
  this.position.x += this.velocity.x;
  this.position.y += this.velocity.y;

  // spin confetto by scaling y and set the color, .09 just slows cosine frequency
  this.scale.y = Math.cos((this.position.y + this.randomModifier) * 0.09);
};

// add elements to arrays to be drawn
initBurst = () => {
  for (let i = 0; i < confettiCount; i++) {
    confetti.push(new Confetto());
  }
  if(!animation_played) {
    setTimeout(function() {
      canvas.parentElement.classList.add('bg-secondary');
      const heading_text = document.getElementById("heading_text");
      heading_text.style.opacity = 0;
      heading_text.parentElement.style.background = null;
      heading_text.addEventListener("transitionend", function() {
        heading_text.innerHTML = "You made it";
        heading_text.style.opacity = 1;
        document.getElementById("heading_subtext").style.opacity = 1;
        document.getElementById("confetti_action").style.opacity = 0.5;
        animation_played = true;
      });
    }, 2500);
  }
};

// draws the elements on the canvas
render = () => {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  confetti.forEach((confetto, index) => {
    let width = confetto.dimensions.x * confetto.scale.x;
    let height = confetto.dimensions.y * confetto.scale.y;

    // move canvas to position and rotate
    ctx.translate(confetto.position.x, confetto.position.y);
    ctx.rotate(confetto.rotation);

    // update confetto "physics" values
    confetto.update();

    // get front or back fill color
    ctx.fillStyle =
      confetto.scale.y > 0 ? confetto.color.front : confetto.color.back;

    // draw confetto
    ctx.fillRect(-width / 2, -height / 2, width, height);

    // reset transform matrix
    ctx.setTransform(1, 0, 0, 1, 0, 0);
  });

  // remove confetti and sequins that fall off the screen
  // must be done in seperate loops to avoid noticeable flickering
  confetti.forEach((confetto, index) => {
    if (confetto.position.y >= canvas.height) confetti.splice(index, 1);
  });

  window.requestAnimationFrame(render);
};

// re-init canvas if the window size changes
resizeCanvas = () => {
  canvas.width = canvas.parentElement.clientWidth;
  canvas.height = canvas.parentElement.clientHeight;
  cx = ctx.canvas.width / 2;
  cy = ctx.canvas.height / 2;
};

// resize listenter
window.addEventListener("resize", () => {
  resizeCanvas();
});

// kick off the render loop
window.initBurst();
render();
</script>
@endsection
