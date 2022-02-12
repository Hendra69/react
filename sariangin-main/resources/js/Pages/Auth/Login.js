import React, { useEffect, useState } from "react";
import { Inertia } from "@inertiajs/inertia";
import { UserOutlined, LockOutlined } from "@ant-design/icons";
import {
  Button,
  Card,
  Checkbox,
  Form,
  Image,
  Input,
  message,
  Space,
} from "antd";

export default function Login({ errors }) {
  const [submitLoading, setSubmitLoading] = useState(false);

  useEffect(() => {
    Object.keys(errors).map((field) => message.error(errors[field]));
  }, [errors]);

  useEffect(() => {
    return Inertia.on("start", (event) => {
      setSubmitLoading(true);
    });
  }, []);

  useEffect(() => {
    return Inertia.on("finish", (event) => {
      setSubmitLoading(false);
    });
  }, []);

  const onFinish = (values) => {
    Inertia.post(route("auth.login"), values);
  };

  const loginPageStyle = {
    background: "#f0f2f5",
    display: "flex",
    width: "100%",
    minHeight: "100vh",
    alignItems: "center",
    justifyContent: "center",
  };

  return (
    <div style={loginPageStyle}>
      <Space direction="vertical" align="center">
        <Image
          preview={false}
          style={{
            display: "block",
            margin: "0 auto",
          }}
          width={128}
          src="/storage/assets/logo.png"
        />
        <Card title="Sari Angin Cirebon">
          <Form
            style={{ width: 300 }}
            layout="vertical"
            requiredMark="optional"
            onFinish={onFinish}
          >
            <Form.Item
              name="username"
              label="Username"
              rules={[
                {
                  required: true,
                  message: "Harap masukkan username anda",
                },
              ]}
            >
              <Input
                type="text"
                prefix={<UserOutlined />}
                placeholder="Username"
              />
            </Form.Item>
            <Form.Item
              name="password"
              label="Password"
              rules={[
                {
                  required: true,
                  message: "Harap masukkan password anda",
                },
              ]}
            >
              <Input.Password
                prefix={<LockOutlined />}
                type="password"
                placeholder="Password"
              />
            </Form.Item>

            <Form.Item name="remember" valuePropName="checked">
              <Checkbox>Remember me</Checkbox>
            </Form.Item>

            <Form.Item>
              <Button
                type="primary"
                htmlType="submit"
                style={{ width: "100%" }}
                loading={submitLoading}
              >
                Log in
              </Button>
            </Form.Item>
          </Form>
        </Card>
      </Space>
    </div>
  );
}
