// @ts-check
// Note: type annotations allow type checking and IDEs autocompletion

const lightCodeTheme = require("prism-react-renderer/themes/github");
const darkCodeTheme = require("prism-react-renderer/themes/dracula");

/** @type {import('@docusaurus/types').Config} */
const config = {
  title: "Badaso Midtrans Module Documentation",
  tagline: "Badaso Midtrans Module official documentation",
  url: "https://github.com/uasoft-indonesia/badaso-midtrans-module",
  baseUrl: "/",
  onBrokenLinks: "throw",
  onBrokenMarkdownLinks: "warn",
  favicon: "img/favicon.ico",
  organizationName: "uasoft", // Usually your GitHub org/user name.
  projectName: "badaso-midtrans-module", // Usually your repo name.
  trailingSlash: false,

  i18n: {
    defaultLocale: "en",
    locales: ["en", "id"],
  },

  presets: [
    [
      "classic",
      /** @type {import('@docusaurus/preset-classic').Options} */
      ({
        docs: {
          sidebarPath: require.resolve("./sidebars.js"),
          // Please change this to your repo.
          editUrl:
            "https://github.com/uasoft-indonesia/badaso-midtrans-module/tree/main/src/website/",
          routeBasePath: "/",
        },
        blog: {
          showReadingTime: true,
          // Please change this to your repo.
          editUrl:
            "https://github.com/uasoft-indonesia/badaso-midtrans-module/tree/main/src/website/",
        },
        theme: {
          customCss: require.resolve("./src/css/custom.css"),
        },
      }),
    ],
  ],

  themeConfig:
    /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
    ({
      navbar: {
        title: "Badaso Midtrans Module",
        logo: {
          alt: "Badaso Midtrans Module Logo",
          src: "img/badaso-module-logo.png",
        },
        items: [
          // {
          //   type: "doc",
          //   docId: "introduction",
          //   position: "left",
          //   label: "Tutorial",
          // },

          {
            type: "localeDropdown",
            position: "right",
          },

          {
            href: "https://github.com/uasoft-indonesia/badaso-midtrans-module",
            label: "Gitlab",
            position: "right",
          },
        ],
      },
      footer: {
        style: "dark",
        links: [
          {
            title: "Learn",
            items: [
              {
                label: "Introduction",
                to: "/",
              },
              {
                label: "Installation",
                to: "/getting-started/installation",
              },
            ],
          },
          {
            title: "Community",
            items: [
              {
                label: "Facebook",
                href: "https://www.facebook.com/groups/badaso",
              },
              {
                label: "Telegram",
                href: "https://t.me/badaso_developers",
              },
            ],
          },
          {
            title: "More",
            items: [
              {
                label: "Donation",
                to: "https://opencollective.com/badaso",
              },
            ],
          },
        ],
        copyright: `Copyright © ${new Date().getFullYear()} UASOFT. All right reserved`,
      },
      prism: {
        theme: lightCodeTheme,
        darkTheme: darkCodeTheme,
      },
    }),
};

module.exports = config;
