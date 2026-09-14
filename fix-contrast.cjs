const fs = require('fs');
const path = require('path');

const directory = path.join(__dirname, 'resources', 'views');

const replacements = [
    { regex: /text-white\/([0-9]+)/g, replace: 'text-[#2D2420]/$1' },
    { regex: /text-white(?!\/)/g, replace: 'text-[#2D2420]' },
    { regex: /bg-\[\#0A0A0A\]/g, replace: 'bg-[#FAF7F2]' },
    { regex: /bg-\[\#050505\]/g, replace: 'bg-[#FDFBF7]' },
    { regex: /bg-white\/5/g, replace: 'bg-[#FDFBF7]' },
    { regex: /bg-white\/10/g, replace: 'bg-[#2D2420]/5' },
    { regex: /border-white\/([0-9]+)/g, replace: 'border-[#2D2420]/10' },
    { regex: /text-\[\#FF2E63\]/g, replace: 'text-[#4E342E]' },
    { regex: /bg-\[\#FF2E63\]/g, replace: 'bg-[#4E342E]' },
    { regex: /ph-(fill|bold|regular) /g, replace: 'ph-light ' },
    { regex: /ring-black\/5/g, replace: 'ring-[#2D2420]/5' },
];

// Folders to process (public frontend only)
const targetFolders = [
    'auth', 'checkout', 'components', 'menu', 'orders', 'outlets', 'promo', '' 
];

function processFile(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    
    // Skip the ones we already meticulously designed manually
    if (filePath.includes('home.blade.php') || filePath.includes('about.blade.php') || filePath.includes('menu\\index.blade.php') || filePath.includes('menu/index.blade.php') || filePath.includes('layouts\\app.blade.php') || filePath.includes('layouts/app.blade.php') || filePath.includes('components\\navbar.blade.php') || filePath.includes('components/navbar.blade.php')) {
        return;
    }

    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;

    replacements.forEach(({ regex, replace }) => {
        content = content.replace(regex, replace);
    });

    if (content !== original) {
        fs.writeFileSync(filePath, content, 'utf8');
        console.log(`Updated: ${filePath}`);
    }
}

function traverseDirectory(dir) {
    const files = fs.readdirSync(dir);
    
    files.forEach(file => {
        const fullPath = path.join(dir, file);
        const stat = fs.statSync(fullPath);
        
        if (stat.isDirectory()) {
            // Check if it's a target folder
            const relativeDir = path.relative(directory, fullPath).replace(/\\/g, '/');
            
            // Only traverse into specific folders, avoid admin/kasir if possible, but let's just fix everything public
            if (!relativeDir.startsWith('admin') && !relativeDir.startsWith('kasir') && !relativeDir.startsWith('layouts')) {
                traverseDirectory(fullPath);
            }
        } else {
            processFile(fullPath);
        }
    });
}

traverseDirectory(directory);

console.log('Contrast fix complete.');
