import React from "react";
import { Button, Col, Form, Input, Row, Select } from "antd";

export const CustomerForm = ({
  children,
  customerTypes,
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
            name="type"
            label="Kategori"
            rules={[{ required: true, message: "Kategori dibutuhkan" }]}
          >
            <Select
              options={customerTypes}
              optionFilterProp="label"
              optionLabelProp="label"
            />
          </Form.Item>

          <Form.Item
            name="name"
            label="Nama"
            rules={[{ required: true, message: "Nama dibutuhkan" }]}
          >
            <Input placeholder="Nama" />
          </Form.Item>

          <Form.Item
            name="phone"
            label="Nomor telepon"
            rules={[{ required: true, message: "Nomor telepon dibutuhkan" }]}
          >
            <Input placeholder="Nomor telepon" />
          </Form.Item>

          <Form.Item
            name="email"
            label="Email"
            rules={[
              { type: "email", message: "Harap masukkan email yang valid" },
              { required: true, message: "Email dibutuhkan" },
            ]}
          >
            <Input placeholder="Email" />
          </Form.Item>
        </Col>

        <Col span={12}>
          <Form.Item
            name="address"
            label="Alamat"
            rules={[{ required: true, message: "Alamat dibutuhkan" }]}
          >
            <Input.TextArea rows={4} placeholder="Alamat" />
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
