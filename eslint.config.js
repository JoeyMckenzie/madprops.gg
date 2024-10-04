import antfu from "@antfu/eslint-config";
import tailwind from "eslint-plugin-tailwindcss";

export default antfu(
    {
        vue: true,
        typescript: true,
        stylistic: {
            indent: 4,
            quotes: "double",
            semi: true,
        },
    },
    ...tailwind.configs["flat/recommended"],
    {
        settings: {
            tailwindcss: {
                config: "tailwind.config.ts",

                cssFiles: ["resources/css/app.css"],
            },
        },
    },
    {
        ignores: [
            "resources/js/types/global.d.ts",
            "node_modules",
            "package-lock.json",
        ],
    },
);
