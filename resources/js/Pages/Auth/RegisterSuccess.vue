<template>
  <div class="relative flex min-h-screen flex-col items-center justify-center p-6 text-center">
    <!-- tsParticles Component -->
    <Particles
      id="tsparticles"
      :options="particlesOptions"
      class="absolute inset-0 z-0"/>

    <ApplicationLogo
      variant="icon"
      class="absolute left-5 top-5 size-32 text-white"/>

    <!-- Content Container -->
    <div class="relative z-10 w-full max-w-md rounded-xl bg-white p-6 shadow-md">
      <h1 class="mb-4 text-3xl font-bold">
        🎉 Success!
      </h1>

      <p class="mb-6 text-lg">
        You're all set. Your account is active and your credit dashboard is ready.
      </p>

      <h2 class="mb-2 text-xl font-semibold">
        Next Steps
      </h2>

      <ul class="list-disc space-y-2 pl-5 text-left text-gray-700">
        <li>🔍 Check your credit score and report details</li>

        <li>🛡️ Activate identity protection features</li>

        <li>💡 Review tips to improve your score</li>

        <li>🚀 Upgrade to premium for full protection</li>
      </ul>

      <div class="mt-6">
        <Link :href="route('dashboard')">
          <Button>
            Go to Dashboard
          </Button>
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import ApplicationLogo from '@/components/ApplicationLogo.vue'
import Button from '@/components/ui/button/Button.vue'
import { Link } from '@inertiajs/vue3'
import { onMounted } from 'vue'

onMounted(() => {
  const script = document.createElement('script')
  script.src = 'https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js'
  script.async = true

  script.onload = () => {
    if (typeof confetti === 'function') {
      confetti({
        particleCount: 100,
        spread: 70,
        origin: { y: 0.6 }
      })
    } else {
      console.warn('confetti function not available after script load')
    }
  }

  script.onerror = () => {
    console.error('Failed to load the confetti script')
  }

  document.head.appendChild(script)
})
</script>

<style scoped>

</style>

