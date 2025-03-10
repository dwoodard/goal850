import {
  onMounted,
  onUnmounted,
  ref
} from 'vue'

class Particle {
  constructor(x, y, size, color, speedX, speedY) {
    this.x = x
    this.y = y
    this.size = size
    this.color = color
    this.speedX = speedX
    this.speedY = speedY
  }

  draw(ctx) {
    ctx.beginPath()
    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2)
    ctx.fillStyle = this.color
    ctx.fill()
  }

  update(canvasWidth, canvasHeight) {
    this.x += this.speedX
    this.y += this.speedY

    // Bounce off edges
    if (this.x + this.size > canvasWidth || this.x - this.size < 0) {
      this.speedX = -this.speedX
    }
    if (this.y + this.size > canvasHeight || this.y - this.size < 0) {
      this.speedY = -this.speedY
    }
  }
}

export function useParticles(numParticles = 50, rgbaColor = [0, 255, 0, 1]) {
  const canvasRef = ref(null)
  const particles = []
  let animationFrameId = null

  const setupParticles = (canvas) => {
    particles.length = 0
    for (let i = 0; i < numParticles; i++) {
      const size = Math.random() * 3 + 1
      const x = Math.random() * canvas.width
      const y = Math.random() * canvas.height
      const opacity = rgbaColor[3] || Math.random() * (0.5 - 0.1) + 0.1
      const color = `rgba(${rgbaColor[0]}, ${rgbaColor[1]}, ${rgbaColor[2]}, ${opacity})`
      const speedX = (Math.random() - 0.5) * 1
      const speedY = (Math.random() - 0.5) * 1
      particles.push(new Particle(x, y, size, color, speedX, speedY))
    }
  }

  const animateParticles = (ctx, canvas) => {
    ctx.clearRect(0, 0, canvas.width, canvas.height)
    particles.forEach((particle) => {
      particle.update(canvas.width, canvas.height)
      particle.draw(ctx)
    })
    animationFrameId = requestAnimationFrame(() => animateParticles(ctx, canvas))
  }

  onMounted(() => {
    const canvas = canvasRef.value
    if (canvas) {
      const ctx = canvas.getContext('2d')

      canvas.width = canvas.offsetWidth
      canvas.height = canvas.offsetHeight

      setupParticles(canvas)
      animateParticles(ctx, canvas)

      // Resize event to adjust canvas size
      window.addEventListener('resize', () => {
        canvas.width = canvas.offsetWidth
        canvas.height = canvas.offsetHeight
        setupParticles(canvas)
      })
    }
  })

  onUnmounted(() => {
    cancelAnimationFrame(animationFrameId)
    window.removeEventListener('resize', setupParticles)
  })

  return {
    canvasRef
  }
}
