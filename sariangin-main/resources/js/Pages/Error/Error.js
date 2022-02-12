import React from "react";
import { Link } from "@inertiajs/inertia-react";

import { Row, Col, Button } from "antd";

export default function Error({ status }) {
  console.log("masok");
  const title = {
    503: "Service Unavailable",
    500: "Server Error",
    404: "Page Not Found",
    403: "Forbidden",
  }[status];

  const image = {
    404: "/images/errors/404.svg",
  }[status];

  const description = {
    503: "Sorry, we are doing some maintenance. Please check back soon.",
    500: "Whoops, something went wrong on our servers.",
    404: "Sorry, the page you are looking for could not be found.",
    403: "Sorry, you are forbidden from accessing this page.",
  }[status];

  return (
    <Row className="da-bg-color-primary-4 da-text-center">
      <Col className="da-error-content da-py-32" span={24}>
        <Row className="da-h-100" align="middle" justify="center">
          <Col>
            <img className="da-d-block da-m-auto" src={image} alt={status} />

            <h1 className="da-error-content-title da-mb-sm-0 da-mb-8 da-font-weight-300">
              {status}
            </h1>

            <h2 className="h1 da-mb-sm-0 da-mb-16">{title}</h2>

            <p className="da-mb-32">{description}</p>

            <Link href="/">
              <Button type="primary">Back to Home</Button>
            </Link>
          </Col>
        </Row>
      </Col>

      <Col span={24} className="da-py-24">
        <p className="da-mb-0 da-badge-text">
          COPYRIGHT ©2020 Hypeople, All rights Reserved
        </p>
      </Col>
    </Row>
  );
}
