import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Card, Col, Form, Input, Row } from "antd";
import { routes } from "@/routes";
import { UserForm } from "@/Components/Forms/UserForm/UserForm";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";

export default function EditUser({ user, roles }) {
  const [form] = Form.useForm();

  const handleFinish = (values) => {
    Inertia.post(route(routes.USERS_UPDATE, user.id), values);
  };

  return (
    <Row justify="center" className="da-mb-1">
      <Col lg={18}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs
            breadcrumbs={[
              { name: "Data Pengguna", route: routes.USERS_INDEX },
              { name: "Ubah Pengguna" },
            ]}
          />
          <Col span={24}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Edit Pengguna</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24}>
                  <UserForm
                    name="edit-user"
                    form={form}
                    onFinish={handleFinish}
                    roles={roles}
                    initialValues={{ ...user, role: user.role?.id }}
                  />
                </Col>
              </Row>
            </Card>
          </Col>
        </Row>
      </Col>
    </Row>
  );
}
