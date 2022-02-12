import React from "react";
import { Button, Col, Form, Input, Row, Select } from "antd";

export const TankForm = ({
  children,
  form,
  initialValues,
  name,
  onFinish,
  tankCategories,
  tankStatus,
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
            name="tank_category_id"
            label="Kategori Tabung"
            rules={[{ required: true, message: "Kategori tabung dibutuhkan" }]}
          >
            <Select options={tankCategories} optionLabelProp="label" />
          </Form.Item>

          <Form.Item
            name="serial_number"
            label="Nomor Tabung"
            rules={[{ required: true, message: "Nomor tabung dibutuhkan" }]}
          >
            <Input placeholder="Nomor tabung" />
          </Form.Item>

          <Form.Item
            name="location"
            label="Lokasi Tabung"
            rules={[{ required: true, message: "Lokasi tabung dibutuhkan" }]}
          >
            <Input placeholder="Lokasi tabung" />
          </Form.Item>
        </Col>

        <Col span={12}>
          <Form.Item
            name="status"
            label="Status"
            rules={[{ required: true, message: "Status dibutuhkan" }]}
          >
            <Select
              options={tankStatus}
              optionFilterProp="label"
              optionLabelProp="label"
            />
          </Form.Item>

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
