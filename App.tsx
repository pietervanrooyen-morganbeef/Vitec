
import React from 'react';
import VitecLogo from './components/VitecLogo';
import AnimatedTagline from './components/AnimatedTagline';

const App: React.FC = () => {
  const taglineText = "Innovative Software, Web, and Hardware Solutions.";
  return (
    <div className="min-h-screen bg-slate-900 flex flex-col items-center justify-center p-6 antialiased">
      <header className="text-center">
        <VitecLogo width={320} height={100} className="mb-4" />
        <AnimatedTagline
          text={taglineText}
          className="mt-3"
          // Approximate width based on text length and font size.
          // Adjust as needed for optimal visual appearance.
          // Height can be smaller as it's single line text.
          svgWidth="100%" // Let SVG take available width
          svgHeight={30} // Approximate height for text-lg
        />
      </header>
    </div>
  );
};

export default App;
