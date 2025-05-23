// // src/app.js
// const components = {
//   'navbar': '/src/components/navbar.html',
//   'section2': '/src/components/section2.html',
// };

// async function loadAllComponents() {
//   for (const [name, path] of Object.entries(components)) {
//     try {
//       const response = await fetch(path);
//       if (!response.ok) throw new Error(`Failed to fetch ${path}`);
//       const html = await response.text();
//       document.querySelectorAll(`[data-component="${name}"]`)
//         .forEach(el => el.innerHTML = html);
        
//           if (name === 'navbar') initNavbar();
//     } catch (err) {
//       console.error(err);
//     }
//   }
// }

// document.addEventListener('DOMContentLoaded', loadAllComponents);