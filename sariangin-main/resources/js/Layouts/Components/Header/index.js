import React from "react";

import { Layout, Button, Row, Col } from "antd";
import {
  RiMenuFill,
  RiMoonLine,
  RiSunFoggyLine,
  RiSunLine,
} from "react-icons/ri";
import { Document, Upload } from "react-iconly";

import { HeaderUser } from "./HeaderUser";
import { HeaderNotifications } from "./HeaderNotifications";
import { usePage } from "@inertiajs/inertia-react";

const { Header } = Layout;

export const MenuHeader = (props) => {
  const { auth } = usePage().props;

  const { setVisible } = props;

  // Mobile Sidebar
  const showDrawer = () => {
    setVisible(true);
    setSearchHeader(false);
  };

  const getGreeting = () => {
    const hours = new Date().getHours();

    let time = "Pagi";
    let icon = (
      <RiSunLine
        set="curved"
        size={32}
        className="remix-icon da-update-icon da-text-color-primary-1 da-p-4 da-bg-color-primary-4"
      />
    );
    if (hours < 14) {
      time = "Siang";
    } else if (hours < 18) {
      time = "Sore";
      icon = (
        <RiSunFoggyLine
          set="curved"
          size={32}
          className="remix-icon da-update-icon da-text-color-primary-1 da-p-4 da-bg-color-primary-4"
        />
      );
    } else if (hours < 4) {
      time = "Malam";
      icon = (
        <RiMoonLine
          set="curved"
          size={32}
          className="remix-icon da-update-icon da-text-color-primary-1 da-p-4 da-bg-color-primary-4"
        />
      );
    }

    return (
      <React.Fragment>
        {icon}
        <p className="da-header-left-text-item da-input-label da-text-color-black-100 da-ml-16 da-mb-0">
          {"Selamat " + time + ", " + auth.user.name}
        </p>
      </React.Fragment>
    );
  };

  return (
    <Header>
      <Row
        className="da-w-100 da-position-relative"
        align="middle"
        justify="space-between"
      >
        <Col className="da-mobile-sidebar-button da-mr-24">
          <Button
            className="da-mobile-sidebar-button"
            type="text"
            onClick={showDrawer}
            icon={
              <RiMenuFill
                size={24}
                className="remix-icon da-text-color-black-80"
              />
            }
          />
        </Col>

        <Col xl={16} lg={14} className="da-header-left-text da-d-flex-center">
          {getGreeting()}
        </Col>

        <Col>
          <Row align="middle">
            <Col className="da-d-flex-center da-mr-sm-12 da-mr-16">
              <HeaderNotifications />
            </Col>

            <Col>
              <HeaderUser />
            </Col>
          </Row>
        </Col>
      </Row>
    </Header>
  );
};
