import React from "react";
import { Col, Breadcrumb } from "antd";
import { Link } from "@inertiajs/inertia-react";

export const Breadcrumbs = ({ breadcrumbs = [] }) => {
  // Breadcrumb item example
  // {
  //   name: 'Home',
  //   route 'dashboard.index',
  // }

  return (
    <Col span={24}>
      <Breadcrumb className="da-d-flex da-flex-wrap">
        <Breadcrumb.Item>
          <Link href="/">Home</Link>
        </Breadcrumb.Item>

        {breadcrumbs.map((breadcrumb, index, arr) => {
          if (arr.length - 1 === index) {
            return (
              <Breadcrumb.Item key={index}>{breadcrumb.name}</Breadcrumb.Item>
            );
          } else {
            return (
              <Breadcrumb.Item key={index}>
                <Link href={route(breadcrumb.route)}>{breadcrumb.name}</Link>
              </Breadcrumb.Item>
            );
          }
        })}
      </Breadcrumb>
    </Col>
  );
};
