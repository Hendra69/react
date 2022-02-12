import React from "react";
import { Link, usePage } from "@inertiajs/inertia-react";
import { Divider, Avatar, Row, Col } from "antd";
import { RiSettings3Line } from "react-icons/ri";

export const MenuFooter = (props) => {
  const { auth } = usePage().props;

  return (
    <Row
      className="da-sidebar-footer da-pb-24 da-px-24"
      align="middle"
      justify="space-between"
    >
      <Divider className="da-border-color-black-20 da-mt-0" />

      <Col>
        <Row align="middle">
          <Avatar
            size={36}
            src={auth.user.avatar_url ?? "/images/memoji/memoji-1.png"}
            className="da-mr-8"
          />

          <div>
            <span className="da-d-block da-text-color-black-100 da-p1-body">
              Jane Doe
            </span>

            <Link href="/" className="da-badge-text" onClick={props.onClose}>
              View Profile
            </Link>
          </div>
        </Row>
      </Col>

      <Col>
        <Link href="/" onClick={props.onClose}>
          <RiSettings3Line
            className="remix-icon da-text-color-black-100"
            size={24}
          />
        </Link>
      </Col>
    </Row>
  );
};
