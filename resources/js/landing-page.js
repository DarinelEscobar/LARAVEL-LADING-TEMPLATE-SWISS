import { animate, stagger } from 'animejs'

const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches

const runLandingAnimations = () => {
  if (prefersReducedMotion()) {
    return
  }

  animate({
    targets: '.anime-section-title',
    translateY: [24, 0],
    opacity: [0, 1],
    duration: 850,
    easing: 'easeOutExpo',
    delay: stagger(120, { start: 120 }),
  })

  animate({
    targets: '.anime-feature-card',
    scale: [0.94, 1],
    opacity: [0, 1],
    duration: 650,
    easing: 'easeOutBack',
    delay: stagger(120, { start: 280 }),
  })

  animate({
    targets: '.anime-showcase-card',
    translateX: [-26, 0],
    opacity: [0, 1],
    duration: 780,
    easing: 'easeOutExpo',
    delay: stagger(160, { start: 240 }),
  })

  animate({
    targets: '.anime-fade-up',
    translateY: [18, 0],
    opacity: [0, 1],
    duration: 720,
    easing: 'easeOutCubic',
    delay: stagger(120, { start: 200 }),
  })

  animate({
    targets: '.anime-fade-right',
    translateX: [-24, 0],
    opacity: [0, 1],
    duration: 720,
    easing: 'easeOutCubic',
    delay: stagger(180, { start: 160 }),
  })

  animate({
    targets: '.anime-fade-left',
    translateX: [24, 0],
    opacity: [0, 1],
    duration: 720,
    easing: 'easeOutCubic',
    delay: stagger(180, { start: 160 }),
  })

  animate({
    targets: '.anime-scale-in',
    scale: [0.9, 1],
    opacity: [0.4, 1],
    duration: 900,
    easing: 'easeOutBack',
  })

  animate({
    targets: '.anime-rotate-in',
    rotate: [-8, 0],
    translateY: [12, 0],
    opacity: [0, 1],
    duration: 950,
    easing: 'easeOutBack',
    delay: 150,
  })

  animate({
    targets: '.anime-floating',
    translateY: [-6, 6],
    duration: 2600,
    direction: 'alternate',
    easing: 'easeInOutSine',
    loop: true,
  })
}

const initLandingPage = () => {
  const landingRoot = document.querySelector('[data-landing-page]')
  if (!landingRoot) return

  document.documentElement.classList.add('landing-loaded')
  runLandingAnimations()
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initLandingPage)
} else {
  initLandingPage()
}
