import React from "react";
const containerRef = useRef(null);
const [scrollPosition, setScrollPosition] = useState({ sx: 0, sy: 0 });

const power = 0.025; // Higher value = faster scrolling
let dx = 0,
  dy = 0;

// Linear interpolation function
const li = (a, b, n) => (1 - n) * a + n * b;

const easeScroll = () => {
  setScrollPosition({
    sx: window.scrollX, // horizontal scroll offset
    sy: window.scrollY, // vertical scroll offset
  });
};
const render = () => {
  // Interpolate towards the target scroll positions
  dx = li(dx, scrollPosition.sx, power);
  dy = li(dy, scrollPosition.sy, power);

  // Round values to avoid sub-pixel rendering issues
  dx = Math.floor(dx * 100) / 100;
  dy = Math.floor(dy * 100) / 100;

  // Apply the transform to the container
  if (containerRef.current) {
    containerRef.current.style.transform = `translate3d(-${dx}px, -${dy}px, 0px)`;
  }

  // Apply parallax to each image in the container
  const images = containerRef.current?.querySelectorAll("img");
  images.forEach((img, index) => {
    const factor = 1 + index * 0.1; // Vary the parallax effect per image
    img.style.transform = `translate3d(0px, -${dy * factor}px, 0px)`;
  });

  // Request the next frame
  requestAnimationFrame(render);
};

useEffect(() => {
  // Set initial body height based on the container height
  const container = containerRef.current;
  if (container) {
    document.body.style.height = `${container.clientHeight}px`;
  }

  // Listen for scroll events
  window.addEventListener("scroll", easeScroll);
  window.addEventListener("wheel", easeScroll);

  // Start the rendering loop
  requestAnimationFrame(render);

  return () => {
    window.removeEventListener("scroll", easeScroll);
    window.removeEventListener("wheel", easeScroll);
  };
}, [scrollPosition]);
const Polygon = () => {
  return (
    <div ref={containerRef} className="scroll-container">
      <img src="assets/images/Group 1618872824.png" alt="Cinque Terre" />
      <img src="assets/images/Group 1618872825.png" alt="Forest" />
      <img
        src="assets/images/[freepicdownloader.com]-3d-rendering-living-room-with-wall-panel-decoration-large (1) (2) 2.png"
        alt="Northern Lights"
      />
    </div>
  );
};

export default Polygon;
