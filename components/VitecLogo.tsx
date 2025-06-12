
import React from 'react'; // React.useId requires React import

interface VitecLogoProps {
  width?: string | number;
  height?: string | number;
  className?: string;
}

const VitecLogo: React.FC<VitecLogoProps> = ({ width = 320, height = 100, className = '' }) => {
  // Ensure unique ID for gradient if multiple logos are on the page
  const uniqueGradientId = `vitecLogoGradient_${React.useId().replace(/:/g, "")}`;
  
  const textBaseColor = "#004d00"; // Dark Green
  const shineHighlightColor = "#39FF14"; // Neon Green

  return (
    <svg
      width={width}
      height={height}
      viewBox="0 0 280 80" // Adjusted for "Vitec" text, font size 50
      className={className}
      xmlns="http://www.w3.org/2000/svg"
      aria-labelledby="vitecLogoTitle"
    >
      <title id="vitecLogoTitle">Vitec Company Logo</title>
      <defs>
        <linearGradient 
          id={uniqueGradientId} 
          x1="-100%" 
          y1="50%" 
          x2="0%" 
          y2="50%"
        >
          {/* Base color of the text */}
          <stop offset="0%" stopColor={textBaseColor} />
          {/* Highlight color that sweeps through */}
          <stop offset="50%" stopColor={shineHighlightColor} />
          {/* Base color of the text */}
          <stop offset="100%" stopColor={textBaseColor} />
          
          {/* Animate x1 to move the start of the gradient */}
          <animate 
            attributeName="x1" 
            from="-100%" 
            to="100%" 
            dur="2.5s" 
            repeatCount="indefinite" 
          />
          {/* Animate x2 to move the end of the gradient */}
          <animate 
            attributeName="x2" 
            from="0%" 
            to="200%" 
            dur="2.5s" 
            repeatCount="indefinite" 
          />
        </linearGradient>
      </defs>
      <text
        x="50%"
        y="50%"
        dominantBaseline="middle"
        textAnchor="middle"
        fontFamily="inherit" // Inherits from body style (system-ui stack)
        fontSize="50"
        fontWeight="bold"
        letterSpacing="0.025em" // Slightly wider letter spacing
        fill={`url(#${uniqueGradientId})`}
      >
        Vitec
      </text>
    </svg>
  );
};

export default VitecLogo;
