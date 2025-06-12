
import React from 'react';

interface AnimatedTaglineProps {
  text: string;
  className?: string;
  svgWidth?: string | number;
  svgHeight?: string | number;
}

const AnimatedTagline: React.FC<AnimatedTaglineProps> = ({
  text,
  className = '',
  svgWidth = "100%", // Default to 100% width
  svgHeight = 30    // Default height suitable for text-lg
}) => {
  const uniqueGradientId = `taglineGradient_${React.useId().replace(/:/g, "")}`;
  
  const textBaseColor = "#CBD5E1"; // slate-300 (original tagline color)
  const shineHighlightColor = "#39FF14"; // Neon Green (same as logo highlight)

  // Estimate viewBox width based on text length to keep text responsive.
  // A rough estimate: 10px per character for an 18px font size.
  // This is a simplification; for perfect fitting, measureText or more complex logic would be needed.
  // Or, rely on the SVG scaling if width="100%". For text, viewBox is tricky for responsiveness.
  // We'll use a fixed conceptual width for the viewBox based on a typical length for this tagline,
  // and let the svgWidth prop scale it.
  const estimatedTextWidth = text.length * 9; // Approx. 9 units per char for font size 16-18
  const viewBoxHeight = 24; // A bit more than font size

  return (
    <svg
      width={svgWidth}
      height={svgHeight}
      viewBox={`0 0 ${estimatedTextWidth} ${viewBoxHeight}`} 
      className={className}
      xmlns="http://www.w3.org/2000/svg"
      aria-label={text}
      preserveAspectRatio="xMidYMid meet" // Helps with scaling
    >
      <defs>
        <linearGradient 
          id={uniqueGradientId} 
          x1="-100%" 
          y1="50%" 
          x2="0%" 
          y2="50%"
        >
          <stop offset="0%" stopColor={textBaseColor} />
          <stop offset="50%" stopColor={shineHighlightColor} />
          <stop offset="100%" stopColor={textBaseColor} />
          
          <animate 
            attributeName="x1" 
            from="-100%" 
            to="100%" 
            dur="2.5s" 
            repeatCount="indefinite" 
          />
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
        fontFamily="inherit"
        fontSize="16" // Visually similar to text-lg, adjust as needed
        fontWeight="normal" // Taglines are usually not bold
        fill={`url(#${uniqueGradientId})`}
      >
        {text}
      </text>
    </svg>
  );
};

export default AnimatedTagline;
