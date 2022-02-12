import React from "react";
import { Button, Col, Form, Input, Row, Select } from "antd";

export const TankCategoryForm = ({
  children,
  form,
  initialValues,
  name,
  onFinish,
}) => {
  return (
    <Form
      layout="vertical"
      form={form}
      name={name}
      initialValues={initialValues}
      onFinish={onFinish}
    >
      <Row gutter={[32, 32]}>
        <Col span={12}>
          <Form.Item
            name="name"
            label="Nama Kategori"
            rules={[{ required: true, message: "Nama kategori dibutuhkan" }]}
          >
            <Input placeholder="Nama kategori" />
          </Form.Item>

          <Form.Item
            name="size"
            label="Ukuran Tabung"
            rules={[{ required: true, message: "Ukuran tabung dibutuhkan" }]}
          >
            <Input placeholder="Ukuran tabung" />
          </Form.Item>
        </Col>

        <Col span={12}>
          <Form.Item name="note" label="Informasi Tambahan">
            <Input.TextArea rows={4} placeholder="Informasi tambahan" />
          </Form.Item>

          {children}
        </Col>
      </Row>

      <Form.Item>
        <Button type="primary" htmlType="submit">
          Submit
        </Button>
      </Form.Item>
    </Form>
  );
};
