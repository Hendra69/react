import { Button, Card, Col, Row, Typography } from "antd";
import React from "react";
import { SummaryCard } from "./SummaryCard";

export default function Dashboard(props) {
  const { Title } = Typography;

  const renderCards = () =>
    props.cards.map((data, index) => (
      <Col key={index} xs={24} md={12} lg={6}>
        <SummaryCard title={data.title} value={data.value} />
      </Col>
    ));

  return <Row gutter={[32, 0]}>{renderCards()}</Row>;
}
