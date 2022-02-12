import React from "react";
import { Col, Row } from "antd";

export const PageTitle = (props) => {
  const { title, text } = props;

  return (
    <Col span={24}>
      <Row>
        <Col span={24}>{title && <h1 className="da-mb-8">{title}</h1>}</Col>

        <Col span={24}>
          {text && <p className="da-mb-0 da-p1-body">{text}</p>}
        </Col>
      </Row>
    </Col>
  );
};
