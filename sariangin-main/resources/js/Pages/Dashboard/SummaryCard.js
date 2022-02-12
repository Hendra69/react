import { Card, Col, Row } from "antd";
import React from "react";
import {
  RiMoneyDollarCircleLine,
  RiUserAddLine,
  RiUserStarLine,
} from "react-icons/ri";

export const SummaryCard = (props) => {
  return (
    <Card className="da-border-color-black-40 da-mb-32 da-card-1">
      <Row gutter={16} align="middle">
        <Col
          className="da-mr-lg-8 da-mb-xs-16 da-bg-color-warning-4"
          style={{
            padding: 12,
            marginRight: 8,
            maxHeight: 48,
            borderRadius: "50%",
          }}
        >
          <RiMoneyDollarCircleLine
            className="da-text-color-warning-1 remix-icon"
            size={24}
          />
        </Col>

        <Col span={14}>
          <h5 className="da-mb-4">{props.value}</h5>
          <p className="da-badge-text da-mb-0 da-text-color-black-80">
            {props.title}
          </p>
        </Col>
      </Row>
    </Card>
  );
};
