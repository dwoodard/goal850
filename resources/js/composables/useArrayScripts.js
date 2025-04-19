import { onMounted } from 'vue'

export function useArrayScripts(componentName) {
  const key = import.meta.env.VITE_ARRAY_APP_KEY
  function load(src) {
    if (!document.querySelector(`script[src="${src}"]`)) {
      const s = document.createElement('script')
      s.src = src
      document.head.appendChild(s)
    }
  }
  onMounted(() => {
    const base = 'https://embed.array.io/cms'
    load(`${base}/array-web-component.js?appKey=${key}`)
    load(`${base}/array-${componentName}.js?appKey=${key}`)
  })
}
