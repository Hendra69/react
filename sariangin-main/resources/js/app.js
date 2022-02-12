require("./bootstrap");

import React from "react";
import { render } from "react-dom";
import { createInertiaApp } from "@inertiajs/inertia-react";
import { Authenticated } from "@/Layouts/Authenticated";
import { VerticalLayout } from "@/Layouts/VerticalLayout";
import { InertiaProgress } from "@inertiajs/progress";
import { ConfigProvider } from "antd";
import locale from "antd/lib/locale/id_ID";

const appName =
  window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => {
    const page = require(`./Pages/${name}`).default;
    if (
      !page.layout &&
      !name.startsWith("Auth/") &&
      !name.startsWith("Error/")
    ) {
      page.layout = (page) => <VerticalLayout children={page} />;
    }

    return page;
  },
  setup({ el, App, props }) {
    return render(
      <ConfigProvider locale={locale}>
        <App {...props} />
      </ConfigProvider>,
      el
    );
  },
});

InertiaProgress.init({ color: "#da251c" });
