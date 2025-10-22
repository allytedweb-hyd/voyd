import React, { useState, useRef } from "react";

const HorizontalScrollEffect = () => {
  const [transformX, setTransformX] = useState(0); // Tracks the text's position
  const animationRef = useRef(null); // Reference to animation frame
  const velocityRef = useRef(0); // Tracks the velocity for smooth scrolling

  const handleWheel = (event) => {
    const deltaX = event.deltaX; // Detect horizontal scrolling
    velocityRef.current += deltaX * 0.05; // Reduce the multiplier to slow initial speed

    if (!animationRef.current) {
      animationRef.current = requestAnimationFrame(smoothMove);
    }
  };

  const smoothMove = () => {
    // Slow down the deceleration rate for smoother and slower stopping
    velocityRef.current *= 0.85;

    // Update the transform position within bounds
    setTransformX((prev) => {
      const newTransformX = prev + velocityRef.current;

      // Restrict movement within -200px to +200px
      if (newTransformX > 180) return 180;
      if (newTransformX < -180) return -180;

      return newTransformX;
    });

    // Stop animation when velocity is nearly zero
    if (Math.abs(velocityRef.current) > 0.1) {
      animationRef.current = requestAnimationFrame(smoothMove);
    } else {
      animationRef.current = null;
    }
  };

  return (
    <div
      className="bg-cont"
      onWheel={handleWheel}
      style={{
        height: "100vh",
        display: "flex",
          alignItems: "center",
        color:"white",
        justifyContent: "center",
        overflow: "hidden", // Prevent unintended scrollbars
      }}
      >
           <div
        className="main-line"
        style={{
          position: "absolute",
          top: "103px",
          right: "267px", // Adjust this as needed for initial positioning
          width: "2px",
          height: "121px",
          backgroundColor: "white",
        //   transform: `translateX(${transformX}px)`, // Make line move horizontally
          transition: "transform 0.1s ease-out", // Smooth transition
        }}
      >
        {/* Top and Bottom lines */}
        <div className="top-line"></div>
        <div className="btm-line"></div>
      </div>
      <h6
        style={{
          position: "relative",
          transform: `translateX(${transformX}px)`,
          transition: "transform 0.1s ease-out", // Smooth transition
        }}
      >
    
        horizontal scrolling! 
          </h6>
        
          <h6 className="tx-3"
        style={{
          position: "relative",
          transform: `translateX(${transformX}px)`,
          transition: "transform 0.1s ease-out", // Smooth transition
        }}
      >
        horizontal scrolling!
          </h6>
          <h6 className="tx-4"
        style={{
          position: "relative",
          transform: `translateX(${transformX}px)`,
          transition: "transform 0.1s ease-out", // Smooth transition
        }}
      >
        horizontal scrolling!
          </h6>
          <h6 className="tx-5"
        style={{
          position: "relative",
          transform: `translateX(${transformX}px)`,
          transition: "transform 0.1s ease-out", // Smooth transition
        }}
      >
        horizontal scrolling!
          </h6>
          <h1  style={{
          position: "relative",
          transform: `translateX(${transformX}px)`,
          transition: "transform 0.1s ease-out", // Smooth transition
        }}>
              Design
          </h1>
          
    </div>
  );
};

export default HorizontalScrollEffect;
