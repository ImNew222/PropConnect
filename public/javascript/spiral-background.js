// ========================================
// 3D SPIRAL GEOMETRIC BACKGROUND
// Rotating rectangles with Page Visibility API
// Pauses when tab is hidden to save CPU
// ========================================

(function() {
    'use strict';
    
    const canvas = document.getElementById('heroSpiralCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    let animationId = null;
    let rotation = 0;
    let isVisible = true;  // Track visibility state
    
    // Random spin direction
    const spinDirection = Math.random() > 0.5 ? 1 : -1;
    const startAngle = Math.random() * Math.PI * 2;
    
    // Configuration
    const config = {
        numLayers: 35,
        baseSize: 800,
        rotationSpeed: 0.004 * spinDirection,
        lineColor: 'rgba(80, 80, 80, 0.35)',
        lineWidth: 1
    };
    
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    
    // Draw a single rotated rectangle
    function drawRect(centerX, centerY, width, height, angle) {
        ctx.save();
        ctx.translate(centerX, centerY);
        ctx.rotate(angle);
        ctx.strokeStyle = config.lineColor;
        ctx.lineWidth = config.lineWidth;
        ctx.beginPath();
        ctx.rect(-width / 2, -height / 2, width, height);
        ctx.stroke();
        ctx.restore();
    }
    
    function draw() {
        if (!isVisible) return;  // Don't animate if hidden
        
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        const centerX = canvas.width * 0.5;
        const centerY = canvas.height * 0.5;
        
        // Scroll-based scale
        const scrollY = window.scrollY || 0;
        const scale = 0.8 + (scrollY / 800) * 0.6;
        
        // Draw organized spiral layers
        for (let i = 0; i < config.numLayers; i++) {
            const progress = i / config.numLayers;
            const layerRotation = rotation + startAngle + (progress * Math.PI * 0.6);
            const size = config.baseSize * scale * (0.4 + progress * 0.7);
            const width = size * 1.1;
            const height = size * 0.85;
            const offsetX = Math.sin(layerRotation * 2) * progress * 25;
            const offsetY = Math.cos(layerRotation * 2) * progress * 18;
            
            drawRect(centerX + offsetX, centerY + offsetY, width, height, layerRotation);
        }
        
        rotation += config.rotationSpeed;
        animationId = requestAnimationFrame(draw);
    }
    
    // Start animation
    function startAnimation() {
        if (!isVisible || animationId) return;
        isVisible = true;
        draw();
    }
    
    // Stop animation

    
    // Page Visibility API - pause when tab is hidden
    function handleVisibilityChange() {
        if (document.hidden) {
            stopAnimation();
        } else {
            startAnimation();
        }
    }
    
    function init() {
        canvas.style.position = 'fixed';
        canvas.style.top = '0';
        canvas.style.left = '0';
        canvas.style.width = '100%';
        canvas.style.height = '100%';
        canvas.style.pointerEvents = 'none';
        canvas.style.zIndex = '0';
        
        resizeCanvas();
        startAnimation();
        
        // Event listeners
        window.addEventListener('resize', resizeCanvas);
        document.addEventListener('visibilitychange', handleVisibilityChange);
    }
    
    // Cleanup on page unload
    function cleanup() {
        stopAnimation();
        window.removeEventListener('resize', resizeCanvas);
        document.removeEventListener('visibilitychange', handleVisibilityChange);
    }
    
    // Initialize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    window.addEventListener('beforeunload', cleanup);
    window.addEventListener('pagehide', cleanup);
})();
