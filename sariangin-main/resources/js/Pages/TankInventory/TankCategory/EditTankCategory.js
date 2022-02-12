import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Card, Col, Form, Input, Row } from "antd";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { TankCategoryForm } from "@/Components/Forms/TankCategoryForm/TankCategoryForm";

export default function EditTankCategory({ tankCategory }) {
  const [form] = Form.useForm();

  const handleFinish = (values) => {
    Inertia.post(route(routes.TANK_CATEGORIES_UPDATE, tankCategory.id), values);
  };

  return (
    <Row justify="center" className="da-mb-1">
      <Col lg={18}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs
            breadcrumbs={[
              { name: "Kategori Tabung", route: routes.TANK_CATEGORIES_INDEX },
              { name: "Edit Kategori Tabung" },
            ]}
          />
          <Col span={24}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Edit Kategori Tabung</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24}>
                  <TankCategoryForm
                    name="edit-tank-category"
                    form={form}
                    onFinish={handleFinish}
                    initialValues={tankCategory}
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
