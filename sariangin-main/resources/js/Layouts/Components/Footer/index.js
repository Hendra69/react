import React from "react";
import { Col, Layout, Row } from "antd";
import dayjs from "dayjs";
const { Footer } = Layout;

export const MenuFooter = () => {
  return (
    <Footer className="da-bg-color-black-10">
      <Row align="middle" justify="space-between">
        <Col md={12} span={24}>
          <p className="da-badge-text da-mb-0">PT Sari Angin Cirebon</p>
        </Col>

        <Col
          md={12}
          span={24}
          className="da-mt-sm-8 da-text-sm-center da-text-right"
        >
          <p className="da-badge-text da-mb-0">
            {dayjs().year()} &copy; Tokoweb.co
          </p>
          {/* <a
            href="https://trello.com/b/8ZRmDN5y/yoda-roadmap"
            target="_blank"
            className="da-badge-text"
          >
            🥁 Version: 1
          </a> */}
        </Col>
      </Row>
    </Footer>
  );
};
