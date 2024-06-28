// vite.config.js
import { defineConfig } from "file:///T:/Legacy24/WebGallery/web-gallery/node_modules/vite/dist/node/index.js";
import laravel from "file:///T:/Legacy24/WebGallery/web-gallery/node_modules/laravel-vite-plugin/dist/index.js";
import react from "file:///T:/Legacy24/WebGallery/web-gallery/node_modules/@vitejs/plugin-react/dist/index.mjs";
import path from "path";
var __vite_injected_original_dirname = "T:\\Legacy24\\WebGallery\\web-gallery";
var vite_config_default = defineConfig({
  plugins: [
    react(),
    laravel({
      input: [
        "resources/css/app.css",
        "resources/css/bootstrap-icons.css",
        "resources/js/app.jsx",
        "resources/js/filepond.js",
        "resources/js/flowbite.js",
        "resources/js/alpine.js",
        "resources/js/dropzone.js"
      ],
      refresh: true
    })
  ],
  resolve: {
    alias: {
      "@": path.resolve(__vite_injected_original_dirname, "resources/js"),
      "~bootstrap-icons": path.resolve(__vite_injected_original_dirname, "node_modules/bootstrap-icons")
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJUOlxcXFxMZWdhY3kyNFxcXFxXZWJHYWxsZXJ5XFxcXHdlYi1nYWxsZXJ5XCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCJUOlxcXFxMZWdhY3kyNFxcXFxXZWJHYWxsZXJ5XFxcXHdlYi1nYWxsZXJ5XFxcXHZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9UOi9MZWdhY3kyNC9XZWJHYWxsZXJ5L3dlYi1nYWxsZXJ5L3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCByZWFjdCBmcm9tICdAdml0ZWpzL3BsdWdpbi1yZWFjdCc7XG5pbXBvcnQgcGF0aCBmcm9tICdwYXRoJztcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgICBwbHVnaW5zOiBbXG4gICAgICAgIHJlYWN0KCksXG4gICAgICAgIGxhcmF2ZWwoe1xuICAgICAgICAgICAgaW5wdXQ6IFtcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Nzcy9hcHAuY3NzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Nzcy9ib290c3RyYXAtaWNvbnMuY3NzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2pzL2FwcC5qc3gnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvanMvZmlsZXBvbmQuanMnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvanMvZmxvd2JpdGUuanMnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvanMvYWxwaW5lLmpzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2pzL2Ryb3B6b25lLmpzJyxcbiAgICAgICAgICAgIF0sXG4gICAgICAgICAgICByZWZyZXNoOiB0cnVlLFxuICAgICAgICB9KSxcbiAgICBdLFxuICAgIHJlc29sdmU6IHtcbiAgICAgICAgYWxpYXM6IHtcbiAgICAgICAgICAgICdAJzogcGF0aC5yZXNvbHZlKF9fZGlybmFtZSwgJ3Jlc291cmNlcy9qcycpLFxuICAgICAgICAgICAgJ35ib290c3RyYXAtaWNvbnMnOiBwYXRoLnJlc29sdmUoX19kaXJuYW1lLCAnbm9kZV9tb2R1bGVzL2Jvb3RzdHJhcC1pY29ucycpLFxuICAgICAgICB9XG4gICAgfVxufSk7XG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQWdTLFNBQVMsb0JBQW9CO0FBQzdULE9BQU8sYUFBYTtBQUNwQixPQUFPLFdBQVc7QUFDbEIsT0FBTyxVQUFVO0FBSGpCLElBQU0sbUNBQW1DO0FBS3pDLElBQU8sc0JBQVEsYUFBYTtBQUFBLEVBQ3hCLFNBQVM7QUFBQSxJQUNMLE1BQU07QUFBQSxJQUNOLFFBQVE7QUFBQSxNQUNKLE9BQU87QUFBQSxRQUNIO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsTUFDSjtBQUFBLE1BQ0EsU0FBUztBQUFBLElBQ2IsQ0FBQztBQUFBLEVBQ0w7QUFBQSxFQUNBLFNBQVM7QUFBQSxJQUNMLE9BQU87QUFBQSxNQUNILEtBQUssS0FBSyxRQUFRLGtDQUFXLGNBQWM7QUFBQSxNQUMzQyxvQkFBb0IsS0FBSyxRQUFRLGtDQUFXLDhCQUE4QjtBQUFBLElBQzlFO0FBQUEsRUFDSjtBQUNKLENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
