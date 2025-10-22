import React, { useEffect } from "react";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);

const SlideShow = () => {
  useEffect(() => {
    const container = document.querySelector("main");
    const header = document.getElementById("parallaxHeader");
    const slides = document.querySelectorAll(".slideshow-image");

    // Set up the horizontal scrolling animation
    gsap.to(slides, {
      xPercent: -100 * (slides.length - 1), // Move slides horizontally
      ease: "power2.inOut", // Apply easing for smooth transition
      duration: 2, // Duration for the smooth transition
      scrollTrigger: {
        trigger: container, // Element that triggers the animation
        pin: true, // Pin the container during the scroll
        scrub: 2, // Increase scrub value to slow down the scroll effect
        snap: {
          snapTo: 1 / (slides.length - 1), // Snap to each slide
          duration: 1, // Duration for snapping animation
          ease: "power2.inOut", // Smooth snapping
        },
        end: () => "+=" + container.offsetWidth, // Calculate scrollable width
      },
    });

    // Set up parallax effect for the header
    ScrollTrigger.create({
      trigger: container,
      start: "top top",
      end: "bottom bottom",
      scrub: 2, // Slow down the parallax effect
      onUpdate: (self) => {
        const progress = self.progress; // Track the scroll progress
        gsap.to(header, {
          x: -progress * container.offsetWidth * 2, // Move header faster
          ease: "power2.inOut", // Apply easing for smooth movement
          duration: 2, // Add duration for the transition
        });
      },
    });

    return () => {
      // Clean up GSAP ScrollTriggers when the component is unmounted
      ScrollTrigger.getAll().forEach((trigger) => trigger.kill());
    };
  }, []);

  return (
    <div className="slider">
      <main style={{ overflow: "hidden" }}>
        <div
          className="scroll-container"
          style={{ display: "flex", position: "relative" }}
        >
          {/* Cinque Terre Container */}
          <div
            className="image-container"
            style={{ position: "relative", width: "100vw", flexShrink: 0 }}
          >
            <img
              src="assets/images/Group 1618872824.png"
              alt="Cinque Terre"
              className="slideshow-image"
              style={{ width: "100%", height: "100%", display: "block" }}
            />
            {/* Polygonal Text */}
            <div className="image-text">Cinque Terre</div>
            <div className="line-container">
              <div className="w-line"></div>
            </div>
          </div>
          <img
            src="assets/images/Group 1618872825.png"
            alt="Forest"
            className="slideshow-image"
            style={{ width: "100vw", flexShrink: 0 }}
          />
          <img
            src="assets/images/[freepicdownloader.com]-3d-rendering-living-room-with-wall-panel-decoration-large (1) (2) 2.png"
            alt="Northern Lights"
            className="slideshow-image"
            style={{ width: "100vw", flexShrink: 0 }}
          />
        </div>
      </main>
    </div>
  );
};

export default SlideShow;
