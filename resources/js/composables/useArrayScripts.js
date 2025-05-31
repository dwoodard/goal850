import { onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'

export function useArrayScripts(componentName) {
  const page = usePage()
  const appKey = page.props.array.appKey

  function load(src) {
    if (!document.querySelector(`script[src="${src}"]`)) {
      const s = document.createElement('script')
      s.src = src
      document.head.appendChild(s)
    }
  }
  onMounted(() => {
    const base = 'https://embed.array.io/cms'
    load(`${base}/array-web-component.js?appKey=${appKey}`)
    load(`${base}/array-${componentName}.js?appKey=${appKey}`)
  })
}
