import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Card, Col, Form, Row } from "antd";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { TankForm } from "@/Components/Forms/TankForm/TankForm";

export default function CreateTank({ tankCategories, tankStatus }) {
  const [form] = Form.useForm();

  const handleFinish = (values) => {
    Inertia.post(route(routes.TANKS_STORE), values);
  };

  return (
    <Row justify="center" className="da-mb-1">
      <Col lg={18}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs
            breadcrumbs={[
              { name: "Data Tabung", route: routes.TANKS_INDEX },
              { name: "Buat Tabung Baru" },
            ]}
          />
          <Col span={24}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Buat Tabung Baru</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24}>
                  <TankForm
                    name="create-tank"
                    form={form}
                    onFinish={handleFinish}
                    tankCategories={tankCategories}
                    tankStatus={tankStatus}
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
