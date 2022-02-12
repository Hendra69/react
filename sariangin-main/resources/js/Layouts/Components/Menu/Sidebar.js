import React, { useState, createElement } from "react";
import { Link, usePage } from "@inertiajs/inertia-react";

import { Avatar, Layout, Drawer, Menu, Button, Row, Col } from "antd";
import { RiMenuFoldLine, RiMenuUnfoldLine, RiCloseFill } from "react-icons/ri";

import { navigation } from "@/navigation";
import { MenuLogo } from "./MenuLogo";
import { MenuFooter } from "./MenuFooter";

const { Sider } = Layout;
const { SubMenu } = Menu;

export const Sidebar = (props) => {
  const { visible, setVisible } = props;
  const { auth } = usePage().props;

  const [collapsed, setCollapsed] = useState(false);

  // Mobile Sidebar
  const onClose = () => {
    setVisible(false);
  };

  // Menu
  function toggle() {
    setCollapsed(!collapsed);
  }

  const trigger = createElement(collapsed ? RiMenuUnfoldLine : RiMenuFoldLine, {
    className: "trigger",
    onClick: toggle,
  });

  const menuItems = navigation.map((item, index) => {
    if (item.header) {
      return <Menu.ItemGroup key={index} title={item.header}></Menu.ItemGroup>;
    }

    if (item.children) {
      return (
        <SubMenu key={item.key} icon={item.icon} title={item.title}>
          {item.children.map((child) => (
            <Menu.Item key={child.key} onClick={onClose}>
              <Link href={route(child.route)}>{child.title}</Link>
            </Menu.Item>
          ))}
        </SubMenu>
      );
    } else {
      return (
        <Menu.Item key={item.key} icon={item.icon} onClick={onClose}>
          <Link href={route(item.route)}>{item.title}</Link>
        </Menu.Item>
      );
    }
  });

  return (
    <Sider
      trigger={null}
      collapsible
      collapsed={collapsed}
      theme="light"
      width={256}
      className="da-sidebar"
    >
      <Row
        className="da-mr-12 da-ml-24 da-mt-24"
        align="bottom"
        justify="space-between"
      >
        <Col>{collapsed === false ? <MenuLogo onClose={onClose} /> : ""}</Col>

        <Col className="da-pr-0">
          <Button
            icon={trigger}
            type="text"
            className="da-float-right"
          ></Button>
        </Col>

        {collapsed !== false && (
          <Col className="da-mt-8">
            <Link href="/" onClick={onClose}>
              <img
                className="da-logo"
                src="/storage/assets/logo.png"
                alt="logo"
              />
            </Link>
          </Col>
        )}
      </Row>

      <Menu
        mode="inline"
        defaultSelectedKeys={["dashboard"]}
        selectedKeys={route().current().split(".")[0]}
      >
        {menuItems}
      </Menu>

      {/* {collapsed === false ? (
        <MenuFooter onClose={onClose} />
      ) : (
        <Row
          className="da-sidebar-footer da-py-16"
          align="middle"
          justify="center"
        >
          <Col>
            <Link href="/" onClick={onClose}>
              <Avatar
                size={36}
                src={auth.user.avatar_url ?? "/images/memoji/memoji-1.png"}
              />
            </Link>
          </Col>
        </Row>
      )} */}

      <Drawer
        title={<MenuLogo onClose={onClose} />}
        className="da-mobile-sidebar"
        placement="left"
        closable={true}
        onClose={onClose}
        visible={visible}
        closeIcon={
          <RiCloseFill
            className="remix-icon da-text-color-black-80"
            size={24}
          />
        }
      >
        <Menu
          mode="inline"
          defaultSelectedKeys={["dashboard"]}
          selectedKeys={route().current().split(".")[0]}
        >
          {menuItems}
        </Menu>

        {/* <MenuFooter onClose={onClose} /> */}
      </Drawer>
    </Sider>
  );
};
