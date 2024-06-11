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
                text: "BindingServiceProvider",
                collapsible: true,
                items: [
                    { text: "Introduction", link: "/binding-service-provider/introduction" },
                ],
            },
            {
                text: "JSON:API",
                collapsible: true,
                items: [
                    { text: "introduction", link: "/json-api/introduction" },
                ],
            },
            {
                text: "Query Filters",
                collapsible: true,
                items: [
                    { text: "What is?", link: "/query-filters/what-is" },
                ],
            },
            {
                text: "Custom Exceptions",
                collapsible: true,
                items: [
                    { text: "introduction", link: "/custom-exception/introduction" },
                    { text: "Usage", link: "/custom-exception/usage" },
                ],
            },
            {
                text: 'Interfaces',
                items: [
                    { text: 'Introduction', link: '/repository-interfaces/Introduction' },
                    { text: 'IRepositoryResource', link: '/repository-interfaces/IRepositoryResource' },
                    { text: 'ICreateModel', link: '/repository-interfaces/ICreateModel' },
                    { text: 'IReadModel', link: '/repository-interfaces/IReadModel' },
                    { text: 'IUpdateModel', link: '/repository-interfaces/IUpdateModel' },
                    { text: 'IDeleteModel', link: '/repository-interfaces/IDeleteModel' },
                    { text: 'IListModel', link: '/repository-interfaces/IListModel' },
                    { text: 'IEntitySearch', link: '/repository-interfaces/IEntitySearch' },
                    { text: 'IEntityCount', link: '/repository-interfaces/IEntityCount' },
                ]
            },
            {
                text: "Code Quality",
                items: [
                    { text: "Ensuring Code Quality", link: "/code-quality/code-quality" }
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