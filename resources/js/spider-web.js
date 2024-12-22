export function initSpiderWeb() {
    const container = document.querySelector('.spider-web');
    if (!container) return;

    const lines = [];
    const numLines = 30; // Jumlah garis

    // Buat garis-garis spider web
    for (let i = 0; i < numLines; i++) {
        const line = document.createElement('div');
        line.className = 'web-line';
        container.appendChild(line);
        
        lines.push({
            element: line,
            x: Math.random() * window.innerWidth,
            y: Math.random() * window.innerHeight,
            length: 0,
            angle: 0
        });
    }

    // Update posisi garis saat mouse bergerak
    document.addEventListener('mousemove', (e) => {
        requestAnimationFrame(() => {
            const mouseX = e.clientX;
            const mouseY = e.clientY;

            lines.forEach((line, index) => {
                const dx = mouseX - line.x;
                const dy = mouseY - line.y;
                const angle = Math.atan2(dy, dx);
                const distance = Math.sqrt(dx * dx + dy * dy);

                // Tambahkan variasi berdasarkan index
                const delay = index * 0.05;
                const wave = Math.sin(Date.now() * 0.002 + index * 0.5) * 5;

                line.element.style.width = `${distance}px`;
                line.element.style.transform = `
                    translate(${line.x}px, ${line.y}px)
                    rotate(${angle}rad)
                    translateY(${wave}px)
                `;
                line.element.style.opacity = Math.max(0.1, 1 - distance / 1000);
            });
        });
    });

    // Animasi idle ketika tidak ada gerakan mouse
    let animationFrame;
    function idleAnimation() {
        const time = Date.now() * 0.001;
        
        lines.forEach((line, index) => {
            const wave = Math.sin(time + index * 0.5) * 5;
            const angle = (time * 0.2 + index * (Math.PI * 2 / numLines)) % (Math.PI * 2);
            
            line.element.style.transform = `
                translate(${line.x}px, ${line.y}px)
                rotate(${angle}rad)
                translateY(${wave}px)
            `;
        });

        animationFrame = requestAnimationFrame(idleAnimation);
    }

    idleAnimation();

    // Cleanup pada window resize
    window.addEventListener('resize', () => {
        lines.forEach(line => {
            line.x = Math.random() * window.innerWidth;
            line.y = Math.random() * window.innerHeight;
        });
    });
} 