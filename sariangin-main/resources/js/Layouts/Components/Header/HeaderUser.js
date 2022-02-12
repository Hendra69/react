import React from "react";

import { Menu, Dropdown, Col, Avatar } from "antd";
import {
  User,
  People,
  InfoSquare,
  Calendar,
  Discount,
  Logout,
} from "react-iconly";
import { Link, usePage } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";
import { routes } from "@/routes";

export const HeaderUser = () => {
  const { auth } = usePage().props;

  const userMenu = (
    <Menu>
      <Menu.Item
        key="profile"
        icon={
          <User
            set="curved"
            className="remix-icon da-vertical-align-middle"
            size={16}
          />
        }
      >
        Profile
      </Menu.Item>

      <Menu.Item
        key="logout"
        icon={
          <Logout
            set="curved"
            className="remix-icon da-vertical-align-middle"
            size={16}
          />
        }
        onClick={() => Inertia.post(route(routes.AUTH_LOGOUT))}
      >
        Logout
      </Menu.Item>
    </Menu>
  );

  return (
    <Dropdown overlay={userMenu}>
      <Col className="da-d-flex-center" onClick={(e) => e.preventDefault()}>
        <Avatar
          src={auth.user.avatar_url ?? "/images/memoji/memoji-1.png"}
          size={40}
        />
      </Col>
    </Dropdown>
  );
};
