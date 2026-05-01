{{-- Mapbox Lazy Load Component
     Only loads Mapbox when user clicks Map button --}}

@push('scripts')
<script>
    // Lazy load Mapbox only when needed
    let mapboxLoaded = false;
    
    function loadMapbox() {
        if (mapboxLoaded) return Promise.resolve();
        
        return new Promise((resolve) => {
            // Load Mapbox CSS
            const css = document.createElement('link');
            css.rel = 'stylesheet';
            css.href = 'https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.css';
            document.head.appendChild(css);
            
            // Load custom mapbox CSS
            const customCss = document.createElement('link');
            customCss.rel = 'stylesheet';
            customCss.href = '{{ asset("css/mapbox.css") }}';
            document.head.appendChild(customCss);
            
            // Load Mapbox JS
            const script = document.createElement('script');
            script.src = 'https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.js';
            script.onload = () => {
                // Load custom mapbox JS after Mapbox loads
                const customScript = document.createElement('script');
                customScript.src = '{{ asset("javascript/mapbox.js") }}';
                customScript.onload = () => {
                    mapboxLoaded = true;
                    resolve();
                };
                document.body.appendChild(customScript);
            };
            document.body.appendChild(script);
        });
    }
    
    // Hook into existing map view toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mapBtn = document.querySelector('[data-view="map"]');
        if (mapBtn) {
            mapBtn.addEventListener('click', async function() {
                await loadMapbox();
                console.log('Mapbox loaded on demand');
            });
        }
    });
</script>
@endpush
