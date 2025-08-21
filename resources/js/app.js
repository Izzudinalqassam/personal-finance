import Chart from 'chart.js/auto';

// Make Chart.js available globally
window.Chart = Chart;

// Chart.js default configuration
Chart.defaults.responsive = true;
Chart.defaults.maintainAspectRatio = false;
Chart.defaults.plugins.legend.display = true;
Chart.defaults.plugins.tooltip.enabled = true;

// Custom color palette for charts
window.chartColors = {
    primary: '#3b82f6',
    secondary: '#64748b',
    success: '#10b981',
    danger: '#ef4444',
    warning: '#f59e0b',
    info: '#06b6d4',
    light: '#f8fafc',
    dark: '#1e293b'
};

// Helper function to generate chart colors
window.generateChartColors = function(count, opacity = 1) {
    const colors = Object.values(window.chartColors);
    const result = [];
    for (let i = 0; i < count; i++) {
        const color = colors[i % colors.length];
        result.push(opacity === 1 ? color : color + Math.round(opacity * 255).toString(16).padStart(2, '0'));
    }
    return result;
};

console.log('Chart.js loaded and configured');