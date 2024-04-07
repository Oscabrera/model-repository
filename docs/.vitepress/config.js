export default {
    title: 'Model Repository',
    description: 'Main repository Package for Laravel Model Repository Generator',
    lang: 'en-US',
    themeConfig: {
        logo: '/logo.svg',
        socialLinks: [
            { icon: "github", link: "https://github.com/Oscabrera/model-repository" },
        ],
        nav: [
            { text: "Contact", link: "https://github.com/Oscabrera" },
            { text: "Changelog", link: "https://github.com/Oscabrera/model-repository/releases" },
        ],
        sidebar: [
            {
                text: "getting Started",
                items: [
                    { text: "Introduction", link: "getting-started/Introduction" },
                    { text: "Features", link: "/getting-started/Features" },
                    { text: "Benefits", link: "/getting-started/Benefits" },
                ],
            },
            {
                text: "Usage",
                items: [
                    { text: "Install", link: "/usage/Install" },
                    { text: "Folder Structure", link: "/usage/Folder" },
                    { text: "Error 403", link: "/usage/Authorize" },

                ],
            },
            {
                text: "Query Options",
                collapsible: true,
                items: [
                    { text: "What is?", link: "/query-options/what-is" },
                    { text: "Structure", link: "/query-options/structure" },
                    { text: "Example", link: "/query-options/example" },
                ],
            },
        ],
        footer: {
            message: "Released under the MIT License.",
            copyright: "Copyright © 2024-present Adocs",
        },
    },
    base: '/model-repository/',
}