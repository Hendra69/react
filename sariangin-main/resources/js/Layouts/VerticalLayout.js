import React, { useEffect, useState } from "react";

import ScrollToTop from "react-scroll-up";
import { Layout, Button, message } from "antd";
import { RiArrowUpLine } from "react-icons/ri";

import { Sidebar } from "./Components/Menu/Sidebar";
import { MenuHeader } from "./Components/Header";
import { MenuFooter } from "./Components/Footer";
import { usePage } from "@inertiajs/inertia-react";

const { Content } = Layout;

export const VerticalLayout = (props) => {
  const { children } = props;
  const { errors, flash } = usePage().props;

  useEffect(() => {
    Object.keys(errors).map((field) =>
      message.error(field + ": " + errors[field])
    );
  }, [errors]);

  useEffect(() => {
    if (flash.message) {
      message.info(flash.message);
    }
    if (flash.success) {
      message.success(flash.success);
    }
  }, [flash]);

  const [visible, setVisible] = useState(false);

  return (
    <React.Fragment>
      <Layout className="da-app-layout">
        <Sidebar visible={visible} setVisible={setVisible} />

        <Layout>
          <MenuHeader setVisible={setVisible} />

          <Content className="da-content-main" style={{ paddingBottom: 32 }}>
            {children}
          </Content>

          <MenuFooter />
        </Layout>
      </Layout>

      <div className="scroll-to-top">
        <ScrollToTop showUnder={300} style={{ bottom: "5%" }}>
          <Button
            className="da-primary-shadow"
            type="primary"
            shape="circle"
            icon={<RiArrowUpLine />}
          />
        </ScrollToTop>
      </div>
    </React.Fragment>
  );
};
