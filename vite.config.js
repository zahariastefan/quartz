import { defineConfig } from 'vite'
// import react from '@vitejs/plugin-react'
import {react} from "laravel-mix";
// https://vitejs.dev/config/
export default defineConfig({
    plugins: [react()]
})
