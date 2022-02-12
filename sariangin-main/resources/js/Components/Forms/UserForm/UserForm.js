import React, { useEffect } from "react";
import { Button, Col, Form, Input, Row, Select } from "antd";
import { AvatarUpload } from "../AvatarUpload/AvatarUpload";
import { initial } from "lodash";

export const UserForm = ({
  children,
  form,
  name,
  initialValues,
  onFinish,
  roles,
}) => {
  const handleAvatar = (image) => {
    form.setFieldsValue({ avatar: image });
  };

  return (
    <Form
      layout="vertical"
      form={form}
      name={name}
      initialValues={initialValues}
      onFinish={onFinish}
    >
      <Row gutter={[32, 32]}>
        <Col span={14}>
          <Form.Item
            name="name"
            label="Nama"
            rules={[{ required: true, message: "Nama dibutuhkan" }]}
          >
            <Input placeholder="Nama" />
          </Form.Item>

          <Form.Item
            name="username"
            label="Username"
            rules={[{ required: true, message: "Username dibutuhkan" }]}
          >
            <Input placeholder="Username" />
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

          <Form.Item name="phone" label="Nomor Telepon">
            <Input placeholder="Nomor Telepon" />
          </Form.Item>

          {children}
        </Col>

        <Col span={10}>
          <Form.Item
            name="role"
            label="Role"
            rules={[{ required: true, message: "Role dibutuhkan" }]}
          >
            <Select
              options={roles}
              optionFilterProp="label"
              optionLabelProp="label"
            />
          </Form.Item>

          <Form.Item name="avatar" label="Foto Profil">
            <AvatarUpload
              imageUrl={initialValues?.avatar_url ?? null}
              handleImage={handleAvatar}
            />
          </Form.Item>
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
