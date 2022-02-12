import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Card, Col, Form, Input, Row } from "antd";
import { UserForm } from "@/Components/Forms/UserForm/UserForm";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";

export default function CreateUser(props) {
  const [form] = Form.useForm();

  const { roles } = props;

  const handleFinish = (values) => {
    Inertia.post(route(routes.USERS_STORE), values);
  };

  return (
    <Row justify="center" className="da-mb-1">
      <Col lg={18}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs
            breadcrumbs={[
              { name: "Data Pengguna", route: routes.USERS_INDEX },
              { name: "Buat Pengguna Baru" },
            ]}
          />
          <Col span={24}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Buat Pengguna Baru</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24}>
                  <UserForm
                    name="create-user"
                    form={form}
                    onFinish={handleFinish}
                    roles={roles}
                  >
                    <Form.Item
                      name="password"
                      label="Password"
                      rules={[
                        { required: true, message: "Password dibutuhkan" },
                        { min: 6, message: "Password minimal 6 digit" },
                      ]}
                      hasFeedback
                    >
                      <Input.Password />
                    </Form.Item>

                    <Form.Item
                      name="password_confirmation"
                      label="Konfirmasi Password"
                      dependencies={["password"]}
                      hasFeedback
                      rules={[
                        {
                          required: true,
                          message: "Harap konfirmasi password",
                        },
                        ({ getFieldValue }) => ({
                          validator(_, value) {
                            if (!value || getFieldValue("password") === value) {
                              return Promise.resolve();
                            }

                            return Promise.reject(
                              new Error("Konfirmasi password tidak sesuai")
                            );
                          },
                        }),
                      ]}
                    >
                      <Input.Password />
                    </Form.Item>
                  </UserForm>
                </Col>
              </Row>
            </Card>
          </Col>
        </Row>
      </Col>
    </Row>
  );
}
